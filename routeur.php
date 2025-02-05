<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "utils_inc/inc_verifsDroits.php";
require_once "utils_inc/Data.php";
require_once "modules/DAO/UtilisateurDAO.php";
require_once "modules/DAO/AmieDAO.php";
require_once "modules/Entites/Amie.php";
require_once "modules/Entites/Utilisateur.php";
require_once "modules/DAO/PublicationDAO.php";
require_once "modules/DAO/DashboardDAO.php";
require_once "modules/DAO/NotificationDAO.php";
require_once "modules/Entites/Notification.php";
require_once 'controleurs/UserController.php';
require_once 'controleurs/DashboardController.php';
require_once 'controleurs/PublicationController.php';
require_once 'modules/DAO/messages_amiDAO.php';
require_once "modules/Entites/messages_ami.php";

$action = isset($_GET['action']) ? $_GET['action'] : 'accueil';
$userController = new UserController();
$dashboardController = new DashboardController();
$publicationController = new GoodPublicationController();

if (!isset($_SESSION["id"])) {
    if ($_GET["action"]!="login" && $_GET["action"]!="register" ){   
        header("Location: index.php");
        exit();
    }
}

switch ($action) {
    case 'login':
        require_once "controleurs/login.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Invalid CSRF token');
            }
            $login = $_POST["login"];
            $pass = $_POST["pass"];
            $authController = new AuthController();
            $authController->authenticate($login, $pass);
        }
        exit();

    case 'register':
        require_once "controleurs/login.php";
        if (!isset($_GET['token']) || $_GET['token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }
        $login = $_GET["login"];
        $pass = $_GET["pass"];
        $authController = new AuthController();
        $authController->register($login, $pass);
        exit();

    case 'poste':
        require_once "controleurs/poste.php";
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Invalid CSRF token');
            }
            $publication = new Publication();
            $publication->ajouterPublication($_POST['titre'], $_POST['contenu'], $_FILES['image']);
        }
        exit();

    case 'accueil':
        require_once "controleurs/accueil.php";
        $controller = new PublicationController();
        $controller->listes();
        exit();

    case 'amie':
        require_once "controleurs/amie.php";
        $controller = new AmieController();
        $controller->listes();
        exit();


    case 'deletid':
    case 'deletuser':
    case 'Accepter':
    case 'ajouter':
        require_once "controleurs/deletAmie.php";
        $routeur = new Routeur();
        $routeur->handleRequest();
        exit();


     case 'profile':
        require_once "controleurs/profile.php";

        // Récupérer l'ID de l'utilisateur
        $id_user = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id'];

        // Instancier le contrôleur
        $controller = new ProfilController();

        // Si la méthode est POST, c'est une modification de profil
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller->modifierProfil($id_user);
        } else {
            // Sinon, afficher le profil
            $controller->afficherProfil($id_user);
        }
        exit();
    case 'modifierProfil':
        require_once "controleurs/profile.php";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new ProfilController();
            $controller->modifierProfil($_GET['id']);
        }

    case 'conversation':
        require_once "controleurs/profile.php";
        $controller = new ProfilController();
        $id_destinataire = $_GET['id'];
        $controller->afficherConversation($_SESSION['id'], $id_destinataire);
        break;

    case 'envoyerMessage':
        require_once "controleurs/profile.php";
        $controller = new ProfilController();
        $id_destinataire = $_POST['id_destinataire'];
        $contenu = $_POST['contenu'];
        $controller->envoyerMessage($_SESSION['id'], $id_destinataire, $contenu);
        break;

    case 'Logout':
        // Liste toutes les contributions (exemple)
        session_destroy();
        require_once "index.php";
        break;

    case 'listUsers':
        // Affiche la liste des utilisateurs
        $userController->listUsers();
        break;

    case 'suspend':
        // Suspend un utilisateur
        $id = $_GET['id_user'];
        if ($id) {
            $userController->suspendUser($id);
        } else {
            echo "ID utilisateur manquant.";
        }
        break;

    case 'updateUser':
        header('Content-Type: application/json');
        $response = $userController->updateUser();
        echo json_encode($response);
        exit();


    case 'searchUsers':
        $userController->searchUsers();
        break;

    case 'deleteUser':
        $userController->deleteUser();
        break;

    case 'getRoles':
        $userController->getRoles();
        break;

    case 'dashboard':
        require_once './pages/dashbord.php';
        break;
    
    case 'getDashboardStats':
        $dashboardController->getDashboardStats();
        break;

    case 'getOnlineUsers':
        $dashboardController->getOnlineUsers();
        break;

    case 'getPublicationsPerDay':
        $dashboardController->getPublicationsPerDay();
        break;

    case 'getUserActivity':
        $dashboardController->getUserActivity();
        break;
    
    case 'getEngagementRate':
        $dashboardController->getEngagementRate();
        break;

    case 'getActiveGroups':
        $dashboardController->getActiveGroups();
        break;

    case 'getDatabaseSize':
        $dashboardController->getDatabaseSize();
        break;

    case 'getFailedLogins':
        $dashboardController->getFailedLogins();
        break;

    case 'users':
        require_once './pages/utilisateur.php';
        break;

    case 'listPublications':
        $publicationController->listPublications();
        break;

    case 'blockPublication':
        $id_pub = $_GET['id_pub'] ;
        if ($id_pub) {
            $publicationController->blockPublication($id_pub);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID publication manquant']);
        }
        break;

    case 'activatePublication':
        $id_pub = $_GET['id_pub'] ;
        if ($id_pub) {
            $publicationController->activatePublication($id_pub);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID publication manquant']);
        }
        break;

    case 'deletePublication':
        $id_pub = $_GET['id_pub'];
        if ($id_pub) {
            $publicationController->deletePublication($id_pub);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID publication manquant']);
        }
        break;

    case 'getActiveUsers': $dashboardController->getActiveUsers(); break;
    case 'getSuspendedUsers': $dashboardController->getSuspendedUsers(); break;
    case 'getNewUsers': $dashboardController->getNewUsers(); break;
    case 'getRoleDistribution': $dashboardController->getRoleDistribution(); break;
    case 'getActiveAllGroups': $dashboardController->getActiveAllGroups(); break;
    case 'getFailedLoginsInfo': $dashboardController->getFailedLoginsInfo(); break;

    case 'getPublicationDetails':
        $id_pub = $_GET['id_pub'] ;
        if ($id_pub) {
            $publicationController->getPublicationDetails($id_pub);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID publication manquant']);
        }
        break;

    default:
        echo "<h1>Erreur 404 - Page non trouvée</h1>";
        break;


}
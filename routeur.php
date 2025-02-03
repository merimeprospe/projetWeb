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
require_once "modules/DAO/PublicationDAO.php";
require_once "modules/DAO/NotificationDAO.php";
require_once "modules/Entites/Notification.php";
require_once 'controleurs/UserController.php';
require_once 'controleurs/DashboardController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'accueil';
$userController = new UserController();
$dashboardController = new DashboardController();

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

    case 'profil':
        $id_user = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id_user) {
            $controller = new ProfilController();
            $controller->afficherProfil($id_user);
        } else {
            die("ID utilisateur manquant.");
        }
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

    case 'users':
        require_once './pages/utilisateur.php';
        break;

    case 'settings':
        require_once __DIR__ . '/pages/parametres.php';
        break;

    default:
        echo "<h1>Erreur 404 - Page non trouvée</h1>";
        break;

}

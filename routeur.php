<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "utils_inc/inc_pdo.php";
require_once "utils_inc/inc_verifsDroits.php";
require_once 'modules/DAO/UtilisateurDAO.php';
require_once 'controleurs/UserController.php';
require_once 'controleurs/DashboardController.php';
require_once 'controleurs/PublicationController.php';


$action = $_GET['action'] ?? 'accueil';
$userController = new UserController($pdo);
$dashboardController = new DashboardController($pdo);
$publicationController = new GoodPublicationController($pdo);

// Switch pour gérer les différentes actions
switch ($action) {
    case 'accueil':
        // Page d'accueil
        require_once "controleurs/accueil.php";
        break;


    case 'traiterAuthentification':
        // Gestion de l'authentification
        $action = $_GET['action'] ?? 'accueil';

   
    case 'profil':
        $id_user = $_GET['id'] ?? null;
        if ($id_user) {
            $controller = new ProfilController();
            $controller->afficherProfil($id_user);
        } else {
            die("ID utilisateur manquant.");
        }
        break;
        // Autres cas...

    case 'listUsers':
        // Affiche la liste des utilisateurs
        $userController->listUsers();
        break;

    case 'suspend':
        // Suspend un utilisateur
        $id = $_GET['id_user'] ?? null;
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
        $id_pub = $_GET['id_pub'] ?? null;
        if ($id_pub) {
            $publicationController->blockPublication($id_pub);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID publication manquant']);
        }
        break;

    case 'activatePublication':
        $id_pub = $_GET['id_pub'] ?? null;
        if ($id_pub) {
            $publicationController->activatePublication($id_pub);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID publication manquant']);
        }
        break;

    case 'deletePublication':
        $id_pub = $_GET['id_pub'] ?? null;
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
        $id_pub = $_GET['id_pub'] ?? null;
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

// die("tutépomé ?");
// Fin du fichier router.php
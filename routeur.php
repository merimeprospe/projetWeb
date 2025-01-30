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


$action = $_GET['action'] ?? 'accueil';
$userController = new UserController($pdo);
$dashboardController = new DashboardController($pdo);

// Switch pour gérer les différentes actions
switch ($action) {
    case 'accueil':
        // Page d'accueil
        require_once "controleurs/accueil.php";
        break;


    case 'traiterAuthentification':
        // Gestion de l'authentification

    // Exemple de routeur
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


    case 'toutesContribs':
        // Liste toutes les contributions (exemple)
        require_once "controleurs/controleurContribs.php";
        if (!estConnecte()) {
            header("location:routeur.php"); // Redirection vers la page de connexion
        } else {
            listerToutesContribs();
        }
        break;

    case 'toutesMembre':
        // Liste tous les membres
        require_once "controleurs/controleurMembre.php";
        if (!estConnecte()) {
            header("location:routeur.php"); // Redirection vers la page de connexion
        } else {
            listerToutesMembre();
        }
        break; 

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

die("tutépomé ?");
// Fin du fichier router.php

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
require_once "modules/DAO/NotificationDAO.php";
require_once "modules/Entites/Notification.php";
// Récupérer l'action demandée
$action = $_GET['action'] ?? 'accueil';

switch ($action) {
    case 'accueil':
        require_once "controleurs/accueil.php";
        exit();
    case 'profile':
        require_once "controleurs/profile.php";

        // Récupérer l'ID de l'utilisateur
        $id_user = $_GET['id'] ?? $_SESSION['id'];

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

    default:
        die("Action non reconnue.");
}

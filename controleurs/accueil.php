<?php

require_once "utils_inc/Data.php";
require_once "modules/DAO/PublicationDAO.php";
require_once "modules/DAO/AmieDAO.php";
require_once "modules/DAO/NotificationDAO.php";
require_once "modules/Entites/Notification.php";

class PublicationController {

    private $publicationDAO;
    private $invitDAO;
    private $notificationDAO;

    public function __construct() {
        $con = new Data();
        $conn = $con->getconnection();
        $this->publicationDAO = new PublicationDAO($conn);
        $this->invitDAO = new AmieDAO($conn);
        $this->notificationDAO = new NotificationDAO($conn);
    }

    public function listes() {
        // Appel de la méthode pour afficher les publications
        $tabRes = $this->publicationDAO->afficherPublications();
        $invits = $this->invitDAO->findAlldemande($_SESSION['id']);
        $notif  = $this->notificationDAO->getNotificationsByUserId($_SESSION['id']);
        // Inclusion de la vue
        //echo "bonjour: ".$_SESSION['id'];
        require "pages/accueil.php";
    }
}

// Exemple d'utilisation de la classe
$controller = new PublicationController();
$controller->listes();
?>

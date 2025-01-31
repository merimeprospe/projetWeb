<?php


class PublicationController {

    private $publicationDAO;
    private $invitDAO;
    private $notificationDAO;
    private $utilisateurDAO;

    public function __construct() {
        $con = new Data();
        $conn = $con->getconnection();
        $this->publicationDAO = new PublicationDAO($conn);
        $this->invitDAO = new AmieDAO($conn);
        $this->notificationDAO = new NotificationDAO($conn);
        $this->utilisateurDAO = new UtilisateurDAO($conn);
    }

    public function listes() {
        // Appel de la méthode pour afficher les publications
        $tabRes = $this->publicationDAO->afficherPublications();
        $invits = $this->invitDAO->findAlldemande($_SESSION['id']);
        $notif  = $this->notificationDAO->getNotificationsByUserId($_SESSION['id']);
        $utilisateur = $this->utilisateurDAO->read($_SESSION['id']);

        // Inclusion de la vue
        //echo "bonjour: ".$_SESSION['id'];
        require "pages/accueil.php";
    }
}




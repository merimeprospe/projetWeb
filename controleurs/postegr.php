<?php
session_start();

require_once "../utils_inc/Data.php";
require_once "../modules/DAO/PublicationDAO.php"; 

class Postegr {
    private $conn;
    private $publication;

    public function __construct() {
        $con = new Data();
        $this->conn = $con->getconnection();
        $this->publication = new PublicationDAO($this->conn);
    }

    public function ajouterPublicationgroupe($id_user, $id_groupe, $titre, $contenu, $image) {
        return $this->publication->creategroup($id_user, $id_groupe, $titre, $contenu, $image);
    }

    public function afficherPublications() {
        return $this->publication->afficherPublications();
    }
}

// Vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $postegr = new Postegr();
        $postegr->ajouterPublicationgroupe(
            $_POST['id'], 
            $_POST['id_groupe'], 
            $_POST['titre'], 
            $_POST['contenu'], 
            $_FILES['image']
        );
    } else {
        echo "Erreur : Aucun fichier ou problème lors du téléchargement.";
    }
}
?>
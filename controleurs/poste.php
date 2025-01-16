<?php
session_start();

require_once "../utils_inc/Data.php";
require_once "../modules/DAO/PublicationDAO.php"; 

class Publication {
    private $conn;
    private $publication;

    public function __construct() {
        $con = new Data();
        $this->conn = $con->getconnection();
        $this->publication = new PublicationDAO($this->conn);
    }

    public function ajouterPublication($titre, $contenu, $image) {
        return $this->publication->create($titre, $contenu, $image);
    }

    public function afficherPublications() {
        return $this->publication->afficherPublications();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $publication = new Publication();
    $publication->ajouterPublication($_POST['titre'], $_POST['contenu'], $_FILES['image']);
}

// Pour afficher toutes les publications
$publication = new Publication();
$publication->afficherPublications();
?>
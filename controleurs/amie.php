<?php

class AmieController {

    private $utilisateurDAO;
    private $amieDAO;

    public function __construct() {
        $con = new Data();
        $conn = $con->getconnection();
        $this->amieDAO = new AmieDAO($conn);
        $this->utilisateurDAO = new UtilisateurDAO($conn);
    }

    public function listes() {
        // Appel de la méthode pour afficher les publications
       // $tabRes = $this->publicationDAO->afficherPublications();

        // Inclusion de la vue
        $utilisateur = $this->utilisateurDAO->read($_SESSION['id']);
        $tabRes = $this->utilisateurDAO->readByInitial($_GET["val"]);
        $amis= $this->amieDAO->findByDemandeurAndAmie($_SESSION['id']);
        
        require "pages/amie.php";
    }

    public function control($demandeur, $amie){
        
        $ami = new Amie();
        $ami= $this->amieDAO->findByDemandeurAndAmie($demandeur, $amie);
        return $ami;
    }

    public function simpleFunction() {
        //echo "Fonction appelée avec succès !";
    }
}

// Gestion des requêtes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $controller = new AmieController();

    if ($action == 'simpleFunction') {
        $controller->simpleFunction();
    } elseif ($action == 'listes') {
        $controller->listes();
    }
}


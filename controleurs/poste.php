<?php

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


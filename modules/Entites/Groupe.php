<?php

class Groupe {
    private $id_groupe;
    private $nom_groupe;
    private $description;
    private $id_admin;

    public function __construct($id_groupe, $nom_groupe, $description, $id_admin) {
        $this->id_groupe = $id_groupe;
        $this->nom_groupe = $nom_groupe;
        $this->description = $description;
        $this->id_admin = $id_admin;
    }

    public function getIdGroupe() {
        return $this->id_groupe;
    }

    public function getNomGroupe() {
        return $this->nom_groupe;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getIdAdmin() {
        return $this->id_admin;
    }

    public function setNomGroupe($nom_groupe) {
        $this->nom_groupe = $nom_groupe;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setIdAdmin($id_admin) {
        $this->id_admin = $id_admin;
    }
}

<?php

class Message {
    private $id_message;
    private $contenu;
    private $id_user;
    private $id_groupe;
    private $date_heure;

    public function __construct($id_message, $contenu, $id_user, $id_groupe, $date_heure) {
        $this->id_message = $id_message;
        $this->contenu = $contenu;
        $this->id_user = $id_user;
        $this->id_groupe = $id_groupe;
        $this->date_heure = $date_heure;
    }

    public function getIdMessage() {
        return $this->id_message;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getIdGroupe() {
        return $this->id_groupe;
    }

    public function getDateHeure() {
        return $this->date_heure;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function setIdGroupe($id_groupe) {
        $this->id_groupe = $id_groupe;
    }

    public function setDateHeure($date_heure) {
        $this->date_heure = $date_heure;
    }
}

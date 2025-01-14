<?php

class Publication {
    private $id_pub;
    private $contenu;
    private $id_user;
    private $id_groupe;

    public function __construct($id_pub, $contenu, $id_user, $id_groupe) {
        $this->id_pub = $id_pub;
        $this->contenu = $contenu;
        $this->id_user = $id_user;
        $this->id_groupe = $id_groupe;
    }

    public function getIdPub() {
        return $this->id_pub;
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

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function setIdGroupe($id_groupe) {
        $this->id_groupe = $id_groupe;
    }
}

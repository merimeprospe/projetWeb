<?php

class Utilisateur {
    private $id_user;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $id_role;

    public function __construct($id_user, $nom, $prenom, $email, $password, $id_role) {
        $this->id_user = $id_user;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->id_role = $id_role;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getIdRole() {
        return $this->id_role;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setIdRole($id_role) {
        $this->id_role = $id_role;
    }
}

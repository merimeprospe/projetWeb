<?php

class AuthController {
    private $user;
    private $con;

    public function __construct() {
        $conn = new Data();
        $this->con = $conn->getconnection();
        $this->user = new UtilisateurDAO($this->con);
    }

    public function authenticate($login, $pass) {
        // Appel de la méthode authenticate de l'objet UtilisateurDAO
      
        return $this->user->authenticate($login, $pass);
    }
}

// Utilisation de la classe



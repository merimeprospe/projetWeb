<?php
session_start();

require_once "../utils_inc/Data.php"; // $pdo existe ici désormais
require_once "../modules/DAO/UtilisateurDAO.php"; 


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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST["login"];
    $pass = $_POST["pass"];
    $authController = new AuthController();
    $authController->authenticate($login, $pass);
}
?>

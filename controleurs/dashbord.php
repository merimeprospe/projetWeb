<?php

require_once 'UtilisateurDAO.php';

class DashboardController {
    private $userDAO;

    public function __construct($pdo) {
        $this->UtilisateurDAO = new UserDAO($pdo);
    }

    public function displayUsers() {
        return $this->UtilisateurDAO->findAllUsers();
    }
}
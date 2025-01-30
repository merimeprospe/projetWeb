<?php
require_once __DIR__ . '/../modules/DAO/DashboardDAO.php';

class DashboardController {
    private $dashboardDAO;

    public function __construct($pdo) {
        $this->dashboardDAO = new DashboardDAO($pdo);
    }

    /**
     * Retourne les statistiques générales sous forme de JSON
     */
    public function getDashboardStats() {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->fetchDashboardStats()
        ]);
    }

    /**
     * Retourne les statistiques des utilisateurs en ligne
     */
    public function getOnlineUsers() {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getOnlineUsers()
        ]);
    }

    /**
     * Retourne les publications par jour pour un graphique
     */
    public function getPublicationsPerDay() {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getPublicationsPerDay()
        ]);
    }
}
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
    public function getDashboardStats(): void {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->fetchDashboardStats()
        ]);
    }

    /**
     * Retourne les statistiques des utilisateurs en ligne
     */
    public function getOnlineUsers(): void {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getOnlineUsers()
        ]);
    }

    /**
     * Retourne les publications par jour pour un graphique
     */
    public function getPublicationsPerDay(): void {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getPublicationsPerDay()
        ]);
    }

    public function getUserActivity(): never {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getUserActivityStats()
        ]);
        exit();
    }

    public function getEngagementRate() {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getEngagementRate()
        ]);
        exit();
    }

    public function getActiveGroups() {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getActiveGroups()
        ]);
        exit();
    }

    public function getDatabaseSize() {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getDatabaseSize()
        ]);
        exit();
    }

    public function getFailedLogins(): never {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => true,
            'data' => $this->dashboardDAO->getFailedLogins()
        ]);
        exit();
    }

    private function sendJsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $data]);
        exit();
    }

    public function getActiveUsers(): void { $this->sendJsonResponse($this->dashboardDAO->getActiveUsers()); }
    public function getSuspendedUsers(): void { $this->sendJsonResponse($this->dashboardDAO->getSuspendedUsers()); }
    public function getNewUsers(): void { $this->sendJsonResponse($this->dashboardDAO->getNewUsers()); }
    public function getRoleDistribution(): void { $this->sendJsonResponse($this->dashboardDAO->getRoleDistribution()); }
    public function getActiveAllGroups(): void { $this->sendJsonResponse($this->dashboardDAO->getActiveAllGroups()); }
    public function getFailedLoginsInfo(): void { $this->sendJsonResponse($this->dashboardDAO->getFailedLoginsInfo()); }

}
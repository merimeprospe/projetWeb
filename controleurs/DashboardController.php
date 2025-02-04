<?php
//require_once __DIR__ . '/../modules/DAO/DashboardDAO.php';

class DashboardController {
    private $dashboardDAO;

    public function __construct() {
        $con = new Data();
        $conn = $con->getconnection();
        $this->dashboardDAO = new DashboardDAO($conn);
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

    public function getUserActivity() {
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

    public function getFailedLogins() {
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

    public function getActiveUsers(){ $this->sendJsonResponse($this->dashboardDAO->getActiveUsers()); }
    public function getSuspendedUsers() { $this->sendJsonResponse($this->dashboardDAO->getSuspendedUsers()); }
    public function getNewUsers() { $this->sendJsonResponse($this->dashboardDAO->getNewUsers()); }
    public function getRoleDistribution() { $this->sendJsonResponse($this->dashboardDAO->getRoleDistribution()); }
    public function getActiveAllGroups() { $this->sendJsonResponse($this->dashboardDAO->getActiveAllGroups()); }
    public function getFailedLoginsInfo() { $this->sendJsonResponse($this->dashboardDAO->getFailedLoginsInfo()); }

}
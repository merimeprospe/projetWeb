<?php
class DashboardDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les statistiques globales du dashboard
     */
    public function fetchDashboardStats() {
        $stats = [];

        // 🔹 Nombre total d'utilisateurs
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM utilisateur");
        $stats['total_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // 🔹 Nombre total de publications signalées (ajoutez `signalement` si disponible)
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM publication");
        $stats['reported_posts'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // 🔹 Nombre total de groupes
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM groupe");
        $stats['total_groups'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        return $stats;
    }

    /**
     * Récupère les statistiques des utilisateurs connectés
     */
    public function getOnlineUsers() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM utilisateur WHERE status_connexion = 'online'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Récupère les statistiques des publications par jour
     */
    public function getPublicationsPerDay() {
        $stmt = $this->pdo->query("SELECT DATE_FORMAT(date, '%Y-%m-%d') AS jour, COUNT(*) as total 
                                   FROM publication GROUP BY jour ORDER BY jour DESC LIMIT 7");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
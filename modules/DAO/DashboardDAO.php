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
        $stmt = $this->pdo->query("
            SELECT DATE_FORMAT(created_at, '%Y-%m-%d') AS jour, COUNT(*) as total 
            FROM publication GROUP BY jour ORDER BY jour DESC LIMIT 7
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserActivityStats() {
        $stats = [];

        // Nombre d'utilisateurs actifs
        $stmt = $this->pdo->query("SELECT COUNT(*) AS actifs FROM utilisateur WHERE status_connexion != 'inactif' AND DATE(last_login) >= CURDATE() - INTERVAL 7 DAY");
        $actifs = $stmt->fetch(PDO::FETCH_ASSOC)['actifs'];
        $stats['active_users'] = isset($actifs) ? $actifs : 0;


        // Nouveaux inscrits par mois (derniers 6 mois)
        $stmt = $this->pdo->query("SELECT DATE_FORMAT(created_at, '%Y-%m') AS mois, COUNT(*) AS inscrits FROM utilisateur GROUP BY mois ORDER BY mois DESC LIMIT 6");
        $stats['new_users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nombre d'utilisateurs suspendus
        $stmt = $this->pdo->query("SELECT COUNT(*) AS suspendus FROM utilisateur WHERE is_suspended = 1");
        $actifs = $stmt->fetch(PDO::FETCH_ASSOC)['suspendus'];
        $stats['suspended_users'] = isset($actifs) ? $actifs : 0;

        // Répartition des rôles
        $stmt = $this->pdo->query("SELECT r.nom_role, COUNT(u.id_user) AS total FROM utilisateur u JOIN role r ON u.id_role = r.id_role GROUP BY u.id_role");
        $stats['role_distribution'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stats;
    }

    public function getEngagementRate() {
        $stmt = $this->pdo->query("
            SELECT AVG(total_interactions) AS taux_engagement
            FROM (
                SELECT p.id_pub, COUNT(l.id_like) + COUNT(c.id_commentaire) AS total_interactions
                FROM publication p
                LEFT JOIN like_publication l ON p.id_pub = l.id_pub
                LEFT JOIN commentaire c ON p.id_pub = c.id_pub
                GROUP BY p.id_pub
            ) engagement
        ");

        $result = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
        return isset($result['taux_engagement']) ? $result['taux_engagement'] : 0;

    }

    public function getActiveGroups() {
        $stmt = $this->pdo->query("
            SELECT COUNT(*) AS total FROM groupe WHERE id_groupe IN (
                SELECT DISTINCT id_groupe FROM publication WHERE created_at >= CURDATE() - INTERVAL 30 DAY
            )
        ");
        $result = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
        return isset($result['total']) ? $result['total'] : 0;

    }

    public function getDatabaseSize() {
        $stmt = $this->pdo->query("
            SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb 
            FROM information_schema.tables WHERE table_schema = 'minireseausocial'
        ");
        $result = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
        return isset($result['size_mb']) ? $result['size_mb'] : 0;
    }

    public function getFailedLogins() {
        $stmt = $this->pdo->query("
            SELECT COUNT(*) AS total FROM logs_connexion WHERE status = 'failed' AND timestamp >= CURDATE() - INTERVAL 7 DAY
        ");
        $result = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
        return isset($result['total']) ? $result['total'] : 0;
    }

    // 📌 Utilisateurs Actifs
    public function getActiveUsers() {
        $stmt = $this->pdo->query("SELECT id_user, nom, email FROM utilisateur WHERE status_connexion = 'online'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Utilisateurs Suspendus
    public function getSuspendedUsers() {
        $stmt = $this->pdo->query("SELECT id_user, nom, email FROM utilisateur WHERE is_suspended = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Nouveaux Inscrits
    public function getNewUsers() {
        $stmt = $this->pdo->query("SELECT id_user, nom, DATE(created_at) AS date_inscription FROM utilisateur ORDER BY created_at DESC LIMIT 10");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Répartition des Rôles
    public function getRoleDistribution() {
        $stmt = $this->pdo->query("SELECT r.nom_role, COUNT(u.id_user) as total FROM utilisateur u JOIN role r ON u.id_role = r.id_role GROUP BY u.id_role");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Groupes Actifs
    public function getActiveAllGroups() {
        $stmt = $this->pdo->query("SELECT id_groupe, nom_groupe FROM groupe WHERE id_groupe IN (SELECT DISTINCT id_groupe FROM publication)");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Sécurité - Tentatives de Connexion
    public function getFailedLoginsInfo() {
        $stmt = $this->pdo->query("SELECT id, login_attempt AS email, status, timestamp FROM logs_connexion ORDER BY timestamp DESC LIMIT 10");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
<?php
class DashboardDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les statistiques globales du dashboard
     */
    public function fetchDashboardStats(): array {
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
    public function getOnlineUsers(): mixed {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM utilisateur WHERE status_connexion = 'online'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Récupère les statistiques des publications par jour
     */
    public function getPublicationsPerDay(): mixed {
        $stmt = $this->pdo->query("
            SELECT DATE_FORMAT(created_at, '%Y-%m-%d') AS jour, COUNT(*) as total 
            FROM publication GROUP BY jour ORDER BY jour DESC LIMIT 7
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserActivityStats(): array {
        $stats = [];

        // Nombre d'utilisateurs actifs
        $stmt = $this->pdo->query("SELECT COUNT(*) AS actifs FROM utilisateur WHERE status_connexion != 'inactif' AND DATE(last_login) >= CURDATE() - INTERVAL 7 DAY");
        $stats['active_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['actifs'] ?? 0;

        // Nouveaux inscrits par mois (derniers 6 mois)
        $stmt = $this->pdo->query("SELECT DATE_FORMAT(created_at, '%Y-%m') AS mois, COUNT(*) AS inscrits FROM utilisateur GROUP BY mois ORDER BY mois DESC LIMIT 6");
        $stats['new_users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nombre d'utilisateurs suspendus
        $stmt = $this->pdo->query("SELECT COUNT(*) AS suspendus FROM utilisateur WHERE is_suspended = 1");
        $stats['suspended_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['suspendus'] ?? 0;

        // Répartition des rôles
        $stmt = $this->pdo->query("SELECT r.nom_role, COUNT(u.id_user) AS total FROM utilisateur u JOIN role r ON u.id_role = r.id_role GROUP BY u.id_role");
        $stats['role_distribution'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stats;
    }

    public function getEngagementRate(): mixed {
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
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC)['taux_engagement'] ?? 0 : 0;
    }

    public function getActiveGroups(): mixed {
        $stmt = $this->pdo->query("
            SELECT COUNT(*) AS total FROM groupe WHERE id_groupe IN (
                SELECT DISTINCT id_groupe FROM publication WHERE created_at >= CURDATE() - INTERVAL 30 DAY
            )
        ");
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0 : 0;
    }

    public function getDatabaseSize(): mixed {
        $stmt = $this->pdo->query("
            SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb 
            FROM information_schema.tables WHERE table_schema = 'minireseausocial'
        ");
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC)['size_mb'] ?? 0 : 0;
    }

    public function getFailedLogins(): mixed {
        $stmt = $this->pdo->query("
            SELECT COUNT(*) AS total FROM logs_connexion WHERE status = 'failed' AND timestamp >= CURDATE() - INTERVAL 7 DAY
        ");
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0 : 0;
    }

    // 📌 Utilisateurs Actifs
    public function getActiveUsers(): mixed {
        $stmt = $this->pdo->query("SELECT id_user, nom, email FROM utilisateur WHERE status_connexion = 'online'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Utilisateurs Suspendus
    public function getSuspendedUsers(): mixed {
        $stmt = $this->pdo->query("SELECT id_user, nom, email FROM utilisateur WHERE is_suspended = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Nouveaux Inscrits
    public function getNewUsers(): mixed {
        $stmt = $this->pdo->query("SELECT id_user, nom, DATE(created_at) AS date_inscription FROM utilisateur ORDER BY created_at DESC LIMIT 10");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Répartition des Rôles
    public function getRoleDistribution(): mixed {
        $stmt = $this->pdo->query("SELECT r.nom_role, COUNT(u.id_user) as total FROM utilisateur u JOIN role r ON u.id_role = r.id_role GROUP BY u.id_role");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Groupes Actifs
    public function getActiveAllGroups(): mixed {
        $stmt = $this->pdo->query("SELECT id_groupe, nom_groupe FROM groupe WHERE id_groupe IN (SELECT DISTINCT id_groupe FROM publication)");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📌 Sécurité - Tentatives de Connexion
    public function getFailedLoginsInfo(): mixed {
        $stmt = $this->pdo->query("SELECT id, login_attempt AS email, status, timestamp FROM logs_connexion ORDER BY timestamp DESC LIMIT 10");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
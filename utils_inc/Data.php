 <?php

class Data {
    // Propriétés
    private $conn;


    // Méthode pour obtenir la connexion
    public function getConnection() {
        try {
            // Connexion à la base de données
            $this->conn = new PDO(
                'mysql:host=localhost;dbname=minireseausocial', 
                'root', 
                'root'
            );
            
            // Configuration des options PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->exec("SET NAMES 'utf8'");

            return $this->conn;
        } catch (PDOException $e) {
            // En cas d'erreur, afficher un message
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}



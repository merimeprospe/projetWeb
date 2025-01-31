 <?php

class Data {
    // Propriétés
    private $conn;
    
    // Constructeur
    public function getconnection() {
        $this->conn= new PDO('mysql:host=localhost;dbname=minireseausocial', "root", "root");
        return $this->conn;
    }

}

// Exemple d'utilisation de la classe
$utilisateur = new Data();
$utilisateur->getconnection();

?>
 
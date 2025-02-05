<?php

class PublicationDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($titre, $contenu, $image) {
        $photo = addslashes(file_get_contents($image['tmp_name']));
        $sql = "INSERT INTO publication (titre, contenu, photo, id_user) VALUES ('$titre', '$contenu', '$photo', '1')";

        if ($this->pdo->query($sql) == TRUE) {
            header("Location:../routeur.php?action=accueil");
        } else {
            echo "Erreur: " . $sql . "<br>" . $this->pdo->error;
        }
    }
    public function creategroup($id_user, $id_groupe, $titre, $contenu, $image) {
        try {
            // Récupération du fichier image sous forme de données binaires
            $photo = file_get_contents($image['tmp_name']);
    
            // Requête préparée pour éviter l'injection SQL
            $sql = "INSERT INTO publication (id_user, id_groupe, titre, contenu, photo) 
                    VALUES (:id_user, :id_groupe, :titre, :contenu, :photo)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_groupe', $id_groupe, PDO::PARAM_INT);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
            $stmt->bindParam(':photo', $photo, PDO::PARAM_LOB);
    
            if ($stmt->execute()) {
                // Redirection vers le profil du groupe après publication
                header('Location: ../routeur.php?action=mesGroupes&id_groupe=' . $id_groupe);
                exit(); // Arrêter l'exécution après la redirection
            } else {
                echo "Erreur lors de l'insertion.";
            }
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
        }
    }

    
 

    public function read($id_pub) {
        $stmt = $this->pdo->prepare('SELECT * FROM Publication WHERE id_pub = :id_pub');
        $stmt->execute(['id_pub' => $id_pub]);
        return $stmt->fetchObject('Publication');
    }

    public function afficherPublications() {
        $sql = "SELECT * FROM publication order by created_at DESC";
        $result = $this->pdo->query($sql);
    
        /* if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "ID: " . $row["id_pub"] . " - Titre: " . $row["Titre"] . " - Contenu: " . $row["contenu"] . " - Photo: " . " - ID Utilisateur: " . $row["id_user"] . "<br>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" alt="Photo de l\'objet">';
            }
        } else {
            echo "0 résultats";
        } */

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(Publication $publication) {
        $stmt = $this->pdo->prepare('UPDATE Publication SET contenu = :contenu, id_user = :id_user, id_groupe = :id_groupe WHERE id_pub = :id_pub');
        $stmt->execute([
            'contenu' => $publication->getContenu(),
            'id_user' => $publication->getIdUser(),
            'id_groupe' => $publication->getIdGroupe(),
            'id_pub' => $publication->getIdPub()
        ]);
    }

    public function delete($id_pub) {
        $stmt = $this->pdo->prepare('DELETE FROM Publication WHERE id_pub = :id_pub');
        $stmt->execute(['id_pub' => $id_pub]);
    }

    public function afficherPublicationsGroupe() {
        $sql = "SELECT * FROM publication WHERE id_groupe = :id_groupe order by created_at DESC";
        $result = $this->pdo->query($sql);
    
        /* if ($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "ID: " . $row["id_pub"] . " - Tire: " . $row["Titre"] . " - Contenu: " . $row["contenu"] . " - Photo: " . " - ID Utilisateur: " . $row["id_user"] . "<br>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" alt="Photo de l\'objet">';
            }
        } else {
            echo "0 résultats";
        } */

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
   
  
}

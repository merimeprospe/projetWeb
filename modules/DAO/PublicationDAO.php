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
        } 
        else {
            echo "Erreur: " . $sql . "<br>" . $this->pdo->error;
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

    public function afficherPublicationsByUser($id_user) {
        $stmt = $this->pdo->prepare('SELECT * FROM publication WHERE id_user = :id_user ORDER BY created_at DESC');
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer toutes les publications
    public function getAllPublications() {
        $sql = "SELECT p.id_pub, p.titre, p.contenu, p.photo, u.nom, p.is_visible 
                FROM publication p
                JOIN utilisateur u ON p.id_user = u.id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        var_dump($result); // Debug des données récupérées
        exit; // Stopper l'exécution pour vérifier le résultat
        return $result;


        //return $stmt->fetchAll(PDO::FETCH_OBJ); // Retourner un tableau d'objets
    }

    // Bloquer ou débloquer une publication
    public function toggleVisibility($id_pub) {
        $sql = "UPDATE publications SET is_visible = NOT is_visible WHERE id_pub = :id_pub";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_pub', $id_pub, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function findAllPublications() {
        $sql = "SELECT p.*, u.nom, u.prenom FROM publication p 
                JOIN utilisateur u ON p.id_user = u.id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findPublicationById($id_pub) {
        $stmt = $this->pdo->prepare("
            SELECT p.id_pub, p.Titre, p.contenu, u.nom, u.prenom, 
                COALESCE((SELECT COUNT(*) FROM like_publication lp WHERE lp.id_pub = p.id_pub), 0) AS total_likes,
                COALESCE((SELECT GROUP_CONCAT(CONCAT(lu.nom, ' ', lu.prenom) SEPARATOR ', ') 
                            FROM like_publication lp 
                            JOIN utilisateur lu ON lp.id_user = lu.id_user 
                            WHERE lp.id_pub = p.id_pub), '') AS liked_by
            FROM publication p
            LEFT JOIN utilisateur u ON p.id_user = u.id_user
            WHERE p.id_pub = :id_pub
        ");
        $stmt->execute(['id_pub' => $id_pub]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si des données sont retournées
        if (!$result) {
            return [
                'Titre' => 'Titre inconnu',
                'contenu' => 'Contenu non disponible',
                'nom' => 'Asia',
                'prenom' => ', ça va aller, perse... 😅',
                'total_likes' => 0,
                'liked_by' => ''
            ];
        }

        return $result;
    }


    public function blockPublication($id_pub) {
        $stmt = $this->pdo->prepare("UPDATE publication SET is_visible = 0 WHERE id_pub = :id_pub");
        return $stmt->execute(['id_pub' => $id_pub]);
    }

    public function activatePublication($id_pub) {
        $stmt = $this->pdo->prepare("UPDATE publication SET is_visible = 1 WHERE id_pub = :id_pub");
        return $stmt->execute(['id_pub' => $id_pub]);
    }

    public function deletePublication($id_pub) {
        $stmt = $this->pdo->prepare("DELETE FROM publication WHERE id_pub = :id_pub");
        return $stmt->execute(['id_pub' => $id_pub]);
    }

    public function getPublicationComments($id_pub) {
        $stmt = $this->pdo->prepare("SELECT * FROM commentaire WHERE id_pub = :id_pub");
        $stmt->execute(['id_pub' => $id_pub]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublicationLikes($id_pub) {
        $stmt = $this->pdo->prepare("SELECT * FROM like_publication WHERE id_pub = :id_pub");
        $stmt->execute(['id_pub' => $id_pub]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
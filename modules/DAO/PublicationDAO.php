<?php

class PublicationDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($titre, $contenu, $image)
    {
        $photo = addslashes(file_get_contents($image['tmp_name']));
        $sql = "INSERT INTO publication (titre, contenu, photo, id_user) VALUES ('$titre', '$contenu', '$photo', '1')";

        if ($this->pdo->query($sql) == TRUE) {
            header("Location:../routeur.php?action=accueil");
        } else {
            echo "Erreur: " . $sql . "<br>" . $this->pdo->error;
        }
    }


    public function read($id_pub)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Publication WHERE id_pub = :id_pub');
        $stmt->execute(['id_pub' => $id_pub]);
        return $stmt->fetchObject('Publication');
    }

    public function afficherPublications()
    {
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


    public function update(Publication $publication)
    {
        $stmt = $this->pdo->prepare('UPDATE Publication SET contenu = :contenu, id_user = :id_user, id_groupe = :id_groupe WHERE id_pub = :id_pub');
        $stmt->execute([
            'contenu' => $publication->getContenu(),
            'id_user' => $publication->getIdUser(),
            'id_groupe' => $publication->getIdGroupe(),
            'id_pub' => $publication->getIdPub()
        ]);
    }

    public function delete($id_pub)
    {
        $stmt = $this->pdo->prepare('DELETE FROM Publication WHERE id_pub = :id_pub');
        $stmt->execute(['id_pub' => $id_pub]);
    }

    public function afficherPublicationsByUser($id_user)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM publication WHERE id_user = :id_user ORDER BY created_at DESC');
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //////


    public function getPhotosByUser($userId)
    {
        $stmt = $this->pdo->prepare('
            SELECT photo, created_at 
            FROM publication 
            WHERE id_user = :user_id 
            AND photo IS NOT NULL
            ORDER BY created_at DESC
        ');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPhotosByUserPaginated($userId, $page = 1, $perPage = 12)
    {
        $offset = ($page - 1) * $perPage;

        $stmt = $this->pdo->prepare('
            SELECT photo, created_at 
            FROM publication
            WHERE id_user = :user_id 
            AND photo IS NOT NULL
            ORDER BY created_at DESC
            LIMIT :offset, :perPage
        ');

        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php

class GroupeDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Groupe $groupe) {
        $stmt = $this->pdo->prepare('INSERT INTO Groupe (nom_groupe, description, id_admin) VALUES (:nom_groupe, :description, :id_admin)');
        $stmt->execute([
            'nom_groupe' => $groupe->getNomGroupe(),
            'description' => $groupe->getDescription(),
            'id_admin' => $groupe->getIdAdmin()
        ]);
    }

    public function getGroupeParId($id_groupe) {
        $stmt = $this->pdo->prepare('SELECT * FROM Groupe WHERE id_groupe = :id_groupe');
        $stmt->execute(['id_groupe' => $id_groupe]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getMembresCompletDuGroupe($id_groupe) {
        $stmt = $this->pdo->prepare('
            SELECT u.id_user, u.nom, u.prenom, g.id_admin 
            FROM utilisateur u
            INNER JOIN appartenirgroupe ag ON u.id_user = ag.id_user
            INNER JOIN groupe g ON ag.id_groupe = g.id_groupe
            WHERE ag.id_groupe = :id_groupe
        ');
        $stmt->execute(['id_groupe' => $id_groupe]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update(Groupe $groupe) {
        $stmt = $this->pdo->prepare('UPDATE Groupe SET nom_groupe = :nom_groupe, description = :description, id_admin = :id_admin WHERE id_groupe = :id_groupe');
        $stmt->execute([
            'nom_groupe' => $groupe->getNomGroupe(),
            'description' => $groupe->getDescription(),
            'id_admin' => $groupe->getIdAdmin(),
            'id_groupe' => $groupe->getIdGroupe()
        ]);
    }

    public function delete($id_groupe) {
        $stmt = $this->pdo->prepare('DELETE FROM Groupe WHERE id_groupe = :id_groupe');
        $stmt->execute(['id_groupe' => $id_groupe]);
    }

    public function getTousLesGroupes() {
        $stmt = $this->pdo->query('SELECT id_groupe, nom_groupe, description, photogroupe FROM Groupe');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMembresDuGroupe($idGroupe) {
        $query = '
            SELECT 
                u.nom,
                u.prenom
            FROM 
                utilisateur u
            INNER JOIN 
                appartenirgroupe ag ON u.id_user = ag.id_user
            WHERE 
                ag.id_groupe = :idGroupe
        ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['idGroupe' => $idGroupe]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPublicationsDuGroupe($idUtilisateur, $idGroupe) {
        $query = '
            SELECT 
                p.id_pub,
                p.Titre,
                p.contenu,
                p.created_at,
                p.updated_at,
                p.photo,
                g.nom_groupe,
                u.nom AS auteur_nom,
                u.prenom AS auteur_prenom
            FROM 
                publication p
            INNER JOIN 
                groupe g ON p.id_groupe = g.id_groupe
            INNER JOIN 
                appartenirgroupe ag ON g.id_groupe = ag.id_groupe
            INNER JOIN 
                utilisateur u ON p.id_user = u.id_user
            WHERE 
                ag.id_user = :idUtilisateur
            AND 
                g.id_groupe = :idGroupe
            ORDER BY 
                p.created_at DESC
        ';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'idUtilisateur' => $idUtilisateur,
            'idGroupe' => $idGroupe
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthodes supplémentaires pour gérer l'adhésion et vérifier l'appartenance à un groupe
    public function isMembreDuGroupe($id_user, $id_groupe) {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM appartenirgroupe WHERE id_user = :id_user AND id_groupe = :id_groupe');
        $stmt->execute([
            'id_user' => $id_user,
            'id_groupe' => $id_groupe
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function ajouterMembreGroupe($id_user, $id_groupe) {
        if ($this->isMembreDuGroupe($id_user, $id_groupe)) {
            return false;
        }

        $stmt = $this->pdo->prepare('INSERT INTO appartenirgroupe (id_user, id_groupe) VALUES (:id_user, :id_groupe)');
        $stmt->execute([
            'id_user' => $id_user,
            'id_groupe' => $id_groupe
        ]);
        return true;
    }

    public function quitGroup($id_user, $id_groupe) {
        $stmt = $this->pdo->prepare('DELETE FROM appartenirgroupe WHERE id_user = :id_user AND id_groupe = :id_groupe');
        $stmt->execute([
            'id_user' => $id_user,
            'id_groupe' => $id_groupe
        ]);
    }

    public function getGroupesUtilisateur($id_user) {
        $stmt = $this->pdo->prepare('
            SELECT g.id_groupe, g.nom_groupe, g.photogroupe
            FROM groupe g
            INNER JOIN appartenirgroupe ag ON g.id_groupe = ag.id_groupe
            WHERE ag.id_user = :id_user
        ');
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkIfUserIsMember($userId, $groupId) {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM appartenirgroupe WHERE id_user = :userId AND id_groupe = :groupId');
        $stmt->execute(['userId' => $userId, 'groupId' => $groupId]);
        return $stmt->fetchColumn() > 0;
    }

    // Ajouter un utilisateur au groupe
    public function joinGroup($userId, $groupId) {
        $stmt = $this->pdo->prepare('INSERT INTO appartenirgroupe (id_user, id_groupe) VALUES (:userId, :groupId)');
        return $stmt->execute(['userId' => $userId, 'groupId' => $groupId]);
    }
    
    public function searchGroups($searchText) {
        $query = 'SELECT * FROM groupe WHERE nom_groupe LIKE :searchText';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['searchText' => $searchText . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modifierGroupe($id_groupe, $nom_groupe, $description) {
        $stmt = $this->pdo->prepare('UPDATE groupe SET nom_groupe = :nom_groupe, description = :description WHERE id_groupe = :id_groupe');
        return $stmt->execute([
            'nom_groupe' => $nom_groupe,
            'description' => $description,
            'id_groupe' => $id_groupe
        ]);
    }
    public function supprimerGroupe($id_groupe) {
        $stmt = $this->pdo->prepare('DELETE FROM groupe WHERE id_groupe = :id_groupe');
        return $stmt->execute(['id_groupe' => $id_groupe]);
    }
    
    public function retirerMembre($id_user, $id_groupe) {
        $stmt = $this->pdo->prepare('DELETE FROM appartenirgroupe WHERE id_user = :id_user AND id_groupe = :id_groupe');
        return $stmt->execute([
            'id_user' => $id_user,
            'id_groupe' => $id_groupe
        ]);
    }

    //public function getMembresCompletDuGroupe($id_groupe) {
    //    $stmt = $this->pdo->prepare('
    //        SELECT u.id_user, u.nom, u.prenom 
    //        FROM utilisateur u
    //        INNER JOIN appartenirgroupe ag ON u.id_user = ag.id_user
    //        WHERE ag.id_groupe = :id_groupe
    //    ');
    //    $stmt->execute(['id_groupe' => $id_groupe]);
//        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //}

    public function isUserGroupAdmin($userId, $groupId) {
        $stmt = $this->pdo->prepare('
            SELECT g.id_admin 
            FROM groupe g 
            WHERE g.id_groupe = :groupId AND g.id_admin = :userId
        ');
        $stmt->execute(['userId' => $userId, 'groupId' => $groupId]);
        return $stmt->fetchColumn() !== false;
    }

    public function getGroupWithAdmin($groupId) {
        $stmt = $this->pdo->prepare('
            SELECT g.*, u.nom AS admin_nom, u.prenom AS admin_prenom 
            FROM groupe g
            INNER JOIN utilisateur u ON g.id_admin = u.id_user
            WHERE g.id_groupe = :groupId
        ');
        $stmt->execute(['groupId' => $groupId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countGroupMembers($groupId) {
        $stmt = $this->pdo->prepare('
            SELECT COUNT(*) 
            FROM appartenirgroupe 
            WHERE id_groupe = :groupId
        ');
        $stmt->execute(['groupId' => $groupId]);
        return $stmt->fetchColumn();
    }
    public function getUtilisateursNonMembres($id_groupe) {
        $stmt = $this->pdo->prepare('
            SELECT u.id_user, u.nom, u.prenom 
            FROM utilisateur u
            WHERE u.id_user NOT IN (
                SELECT ag.id_user 
                FROM appartenirgroupe ag 
                WHERE ag.id_groupe = ?
            )
        ');
        $stmt->execute([$id_groupe]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function modifierGroupeComplet($id_groupe, $nom, $description, $photo = null) {
        $sql = 'UPDATE groupe SET nom_groupe = ?, description = ?';
        $params = [$nom, $description];
        
        if ($photo) {
            $sql .= ', photogroupe = ?';
            $params[] = $photo;
        }
        
        $sql .= ' WHERE id_groupe = ?';
        $params[] = $id_groupe;
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function supprimerPublication($id_publication) {
        $sql = "DELETE FROM publication WHERE id_pub = :id_publication";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_publication', $id_publication, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getPublicationById($id_publication) {
        $sql = "SELECT * FROM publication WHERE id_pub = :id_publication";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_publication', $id_publication, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function creerGroupe($nom, $description, $image, $id_admin) {
    try {
        // Gestion de l'image
        $photoGroupe = null;
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $photoGroupe = file_get_contents($image['tmp_name']);
        }

        // Requête avec paramètres nommés
        $stmt = $this->pdo->prepare('
            INSERT INTO groupe 
            (nom_groupe, description, photogroupe, id_admin) 
            VALUES (:nom, :description, :photo, :admin)
        ');
        
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':photo', $photoGroupe, PDO::PARAM_LOB);
        $stmt->bindParam(':admin', $id_admin, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $this->pdo->lastInsertId();
        } else {
            error_log("Erreur d'exécution de la requête");
            return false;
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL creerGroupe: " . $e->getMessage());
        return false;
    }
}
}
?>

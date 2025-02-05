<?php


class UtilisateurDAO {
    private $pdo; // Propriété pour stocker la connexion PDO

    public function __construct($pdo) {
        // Vérification si $pdo est bien un objet PDO
        if ($pdo instanceof PDO) {
            $this->pdo = $pdo;
        } else {
            throw new InvalidArgumentException("Une instance de PDO est requise.");
        }

    }
    

    public function create(Utilisateur $utilisateur)
    {

        $stmt = $this->pdo->prepare('INSERT INTO utilisateur (nom, prenom, email, password, id_role, creer_le, sexe, ville, pays, bio, photo_profil) VALUES (:nom, :prenom, :email, :password, :id_role, :creer_le, :sexe, :ville, :pays, :bio, :photo_profil, :photo_couverture)');
    }
    public function create1($email, $password) {
       /*  $stmt = $this->pdo->prepare('SELECT password FROM utilisateur WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && hash_equals($result['password'], crypt($password, $result['password']))) {
            // Authentification réussie
            echo "Connexion réussie !";
        } else {
            // Authentification échouée
            echo "Email ou mot de passe incorrect.";
        } */

        $textR = "SELECT * FROM utilisateur WHERE email=:login AND password=:pass";
        $req = $this->pdo->prepare($textR);
        $req->bindParam(":login", $email);
        $req->bindParam(":pass", $password);
        $req->execute();

        // 2 possibilités : 1 ligne retournée ou 0 ligne retournée 
        $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);

        if (count($tabRes) != 1) {
           // $salt = '$2y$10$' . bin2hex(openssl_random_pseudo_bytes(22));
            //$hashedPassword = crypt($password, $salt);

            $stmt = $this->pdo->prepare('INSERT INTO utilisateur (email, password) VALUES (:email, :password)');
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $this->authenticate( $email, $password);
        }else {
            $_SESSION['notification'] = "Ce compte existe déjà. Veuillez vous connecter ou utiliser une autre adresse e-mail.";
            header("Location:index.php");
            exit();
        }
    }
    
  
    
    public function readByInitial($initial) {

        $stmt = $this->pdo->prepare('SELECT * FROM Utilisateur WHERE nom LIKE :initial OR prenom LIKE :initial');
        $likeInitial = $initial . '%';
        $stmt->execute(['initial' => $likeInitial]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }




    /*public function read($id_user)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/

    public function read($id_user)
    {
        $stmt = $this->pdo->prepare('SELECT 
            id_user, 
            COALESCE(nom, "") AS nom, 
            COALESCE(prenom, "") AS prenom,
            COALESCE(email, "") AS email,
            COALESCE(sexe, "Non spécifié") AS sexe,
            COALESCE(ville, "") AS ville,
            COALESCE(pays, "") AS pays,
            COALESCE(bio, "") AS bio,
            COALESCE(travail, "") AS travail,
            COALESCE(loisirs, "") AS loisirs,
            COALESCE(creer_le, "") AS creer_le,
            photo_profil,
            photo_couverture
            FROM utilisateur 
            WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne toujours un tableau
    }





    public function update(Utilisateur $utilisateur)
    {
        $stmt = $this->pdo->prepare('
            UPDATE utilisateur SET
                nom = :nom,
                prenom = :prenom,
                email = :email,
                sexe = :sexe,
                ville = :ville,
                pays = :pays,
                bio = :bio,
                photo_profil = :photo_profil,
                travail = :travail,
                loisirs = :loisirs,
                photo_couverture = :photo_couverture
            WHERE id_user = :id_user
        ');
        return $stmt->execute([
            'nom' => $utilisateur->getNom(),
            'prenom' => $utilisateur->getPrenom(),
            'email' => $utilisateur->getEmail(),
            'sexe' => $utilisateur->getSexe(),
            'ville' => $utilisateur->getVille(),
            'pays' => $utilisateur->getPays(),
            'bio' => $utilisateur->getBio(),
            'photo_profil' => $utilisateur->getPhotoProfil(),
            'travail' => $utilisateur->getTravail(),
            'loisirs' => $utilisateur->getLoisirs(),
            'photo_couverture' => $utilisateur->getPhotoCouverture(),
            'id_user' => $utilisateur->getIdUser()
        ]);
    }

    public function delete($id_user)
    {
        $stmt = $this->pdo->prepare('DELETE FROM utilisateur WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $id_user]);
    }

    public function authenticate($login, $pass)
    {
        // Vérification dans la base si le mot de passe et le login se trouvent dans la base
        $textR = "SELECT id_role, id_user, 	is_suspended FROM utilisateur WHERE email=:login AND password=:pass";
        $req = $this->pdo->prepare($textR);
        $req->bindParam(":login", $login);
        $req->bindParam(":pass", $pass);
        $req->execute();

        // 2 possibilités : 1 ligne retournée ou 0 ligne retournée 
        $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);

        if (count($tabRes) != 1) {
            // pas trouvé => retour au formulaire de co
            $_SESSION['notification'] = "Nom d'utilisateur ou mot de passe incorrect";
            header("Location:index.php");
            exit();
        }

        // Si on arrive là : login/pass OK (count==1)
        // Stockage en session : 
        
       

        if ($tabRes[0]["is_suspended"] == "1") {
            $_SESSION['notification'] = "Votre compte a ete bloque en raison d'une activite suspecte. Veuillez contacter le support client pour resoudre ce probleme.";
            header("Location:index.php");
            exit();
        }
        $_SESSION["id"] = $tabRes[0]["id_user"];
        if ($tabRes[0]["id_role"] == "1") {
            // redirection vers accueil, éventuellement spécifique à l'utilisateur
            header("Location: routeur.php?action=accueil");
        }else {
            header("Location: routeur.php?action=dashboard");
        }
        


    }



    public function findAllUsers() {
        // Modifiez la requête SQL pour la table "utilisateur"
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserById($id_user) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un utilisateur
    public function updateUser($data) {
        $stmt = $this->pdo->prepare("
            UPDATE utilisateur 
            SET nom = :nom, prenom = :prenom, email = :email, id_role = :id_role, is_suspended = :is_suspended 
            WHERE id_user = :id_user
        ");
        return $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'id_role' => $data['id_role'],
            'is_suspended' => $data['is_suspended'],
            'id_user' => $data['id_user']
        ]);
    }


     // Méthode pour suspendre un utilisateur
     public function suspendUser($id_user) {
        $query = "UPDATE utilisateur SET is_suspended = 1 WHERE id_user = :id_user AND is_suspended = 0"; // Prevent redundant updates
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id_user' => $id_user]);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            // Debugging: Check why the row is not being updated
            $checkUser = $this->pdo->prepare("SELECT is_suspended FROM utilisateur WHERE id_user = :id_user");
            $checkUser->execute([':id_user' => $id_user]);
            $user = $checkUser->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                error_log("Erreur: Aucun utilisateur trouvé avec ID $id_user");
                return false;
            } elseif ($user['is_suspended'] == 1) {
                error_log("Erreur: L'utilisateur ID $id_user est déjà suspendu.");
                return false;
            } else {
                error_log("Erreur inconnue lors de la suspension de l'utilisateur ID $id_user.");
                return false;
            }
        }
    }

    // ✅ Rechercher et filtrer les utilisateurs
    public function searchUsers($query, $role) {
        $sql = "SELECT * FROM utilisateur WHERE (nom LIKE :query OR prenom LIKE :query OR email LIKE :query)";

        if ($role !== 'all') {
            $sql .= " AND id_role = :role";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);

        if ($role !== 'all') {
            $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Supprimer un utilisateur
    public function deleteUser($id_user) {
        try {
            // 🔍 Supprimer les notifications associées
            $stmt0 = $this->pdo->prepare("DELETE FROM notification WHERE user_id = :id_user");
            $stmt0->execute(['id_user' => $id_user]);
            error_log("Lignes supprimées dans 'notification': " . $stmt0->rowCount());

            // 🔍 Supprimer les relations d’amitié
            $stmt1 = $this->pdo->prepare("DELETE FROM amies WHERE demandeur = :id_user OR amie = :id_user");
            $stmt1->execute(['id_user' => $id_user]);
            error_log("Lignes supprimées dans 'amies': " . $stmt1->rowCount());

            // 🔍 Supprimer l'utilisateur après suppression des références
            $stmt2 = $this->pdo->prepare("DELETE FROM utilisateur WHERE id_user = :id_user");
            $stmt2->execute(['id_user' => $id_user]);


            if ($stmt2->rowCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Aucun utilisateur supprimé ou utilisateur introuvable.']);
            }
        } catch (Exception $e) {
            error_log("Erreur lors de la suppression: " . $e->getMessage());
            echo json_encode(['success' => false, 'error' => 'Erreur SQL: ' . $e->getMessage()]);
        }
        exit();
    }





   public function getAllRoles() {
        try {
            $stmt = $this->pdo->prepare("SELECT id_role, nom_role FROM role ORDER BY nom_role ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return []; // Retourner un tableau vide en cas d'erreur
        }
    }

}
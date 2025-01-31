<?php


class UtilisateurDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Utilisateur $utilisateur) {

        $stmt = $this->pdo->prepare('INSERT INTO utilisateur (nom, prenom, email, password, id_role, creer_le, sexe, ville, pays, bio, photo_profil) VALUES (:nom, :prenom, :email, :password, :id_role, :creer_le, :sexe, :ville, :pays, :bio, :photo_profil, :photo_couverture)');

      
    }

  
    
    public function readByInitial($initial) {
        $stmt = $this->pdo->prepare('SELECT * FROM Utilisateur WHERE nom LIKE :initial OR prenom LIKE :initial');
        $likeInitial = $initial . '%';
        $stmt->execute(['initial' => $likeInitial]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    

  

    public function read($id_user) {
        $stmt = $this->pdo->prepare('SELECT * FROM utilisateur WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    


    public function update(Utilisateur $utilisateur) {
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
            'photo_couverture' => $utilisateur->getPhotoCouverture(),
            'id_user' => $utilisateur->getIdUser()
        ]);
    }

    public function delete($id_user) {
        $stmt = $this->pdo->prepare('DELETE FROM utilisateur WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $id_user]);
    }

    public function authenticate($login, $pass) {
        // Vérification dans la base si le mot de passe et le login se trouvent dans la base
        $textR = "SELECT id_role, id_user FROM utilisateur WHERE email=:login AND password=:pass";
        $req = $this->pdo->prepare($textR);
        $req->bindParam(":login", $login);
        $req->bindParam(":pass", $pass);
        $req->execute();

        // 2 possibilités : 1 ligne retournée ou 0 ligne retournée 
        $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);

        if (count($tabRes) != 1) {
            // pas trouvé => retour au formulaire de co
            $_SESSION['notification'] = "Votre notification ici!";
            header("Location:../index.php");
            exit();
        }

        // Si on arrive là : login/pass OK (count==1)
        // Stockage en session : 
        $_SESSION["id"] = $tabRes[0]["id_user"];

        // redirection vers accueil, éventuellement spécifique à l'utilisateur
        header("Location: routeur.php?action=accueil");
    }
}
?>
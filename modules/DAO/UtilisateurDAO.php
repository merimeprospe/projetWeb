<?php

class UtilisateurDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Utilisateur $utilisateur) {
        $stmt = $this->pdo->prepare('INSERT INTO Utilisateur (nom, prenom, email, password, id_role) VALUES (:nom, :prenom, :email, :password, :id_role)');
        $stmt->execute([
            'nom' => $utilisateur->getNom(),
            'prenom' => $utilisateur->getPrenom(),
            'email' => $utilisateur->getEmail(),
            'password' => $utilisateur->getPassword(),
            'id_role' => $utilisateur->getIdRole()
        ]);
    }

    public function read($id_user) {
        $stmt = $this->pdo->prepare('SELECT * FROM Utilisateur WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchObject('Utilisateur');
    }

    public function update(Utilisateur $utilisateur) {
        $stmt = $this->pdo->prepare('UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email = :email, password = :password, id_role = :id_role WHERE id_user = :id_user');
        $stmt->execute([
            'nom' => $utilisateur->getNom(),
            'prenom' => $utilisateur->getPrenom(),
            'email' => $utilisateur->getEmail(),
            'password' => $utilisateur->getPassword(),
            'id_role' => $utilisateur->getIdRole(),
            'id_user' => $utilisateur->getIdUser()
        ]);
    }

    public function delete($id_user) {
        $stmt = $this->pdo->prepare('DELETE FROM Utilisateur WHERE id_user = :id_user');
        $stmt->execute(['id_user' => $id_user]);
    }

    public function authenticate($login, $pass) {
        // Vérification dans la base si le mot de passe et le login se trouvent dans la base
        $textR = "SELECT id_role FROM utilisateur WHERE email=:login AND password=:pass";
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
        $_SESSION["login"] = $login;

        // redirection vers accueil, éventuellement spécifique à l'utilisateur
        header("Location:../pages/accueil.php");
    }
}

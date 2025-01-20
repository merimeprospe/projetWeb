<?php
ob_start(); // Active la mise en mémoire tampon 
session_start();
require_once "../utils_inc/Data.php"; 
require_once "../modules/DAO/UtilisateurDAO.php"; 
require_once "../modules/DAO/PublicationDAO.php"; 
require_once "../modules/Entites/Utilisateur.php"; 

class ProfilController {
    private $conn;
    private $utilisateurDAO;
    private $publicationDAO;
    private $utilisateur;

    public function __construct() {
        $con = new Data();
        $this->conn = $con->getconnection();
        $this->publicationDAO = new PublicationDAO($this->conn);
        $this->utilisateurDAO = new UtilisateurDAO($this->conn);
    }

    // Afficher le profil de l'utilisateur avec ses publications
    public function afficherProfil($id_user) {
        // Récupérer les informations de l'utilisateur
        $this->utilisateur = $this->utilisateurDAO->read($id_user);
        $utilisateur = $this->utilisateur;

        if (!$utilisateur) {
            // Gérer le cas où l'utilisateur n'existe pas
            header("Location: acceuil.php?action=erreur&message=Utilisateur non trouvé");
            exit();
        }

        // Récupérer les publications de l'utilisateur
        $publications = $this->publicationDAO->afficherPublicationsByUser($id_user);

        // Inclure la vue du profil
        include "../pages/profile.php";
    }

    // Modifier le profil de l'utilisateur
    public function modifierProfil($id_user) {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $sexe = $_POST['sexe'];
        $ville = $_POST['ville'];
        $pays = $_POST['pays'];
        $bio = $_POST['bio'];
    
        // Récupérer l'utilisateur existant
        $this->utilisateur = $this->utilisateurDAO->read($id_user);
    
        // Mettre à jour les informations de l'utilisateur
        $user = new Utilisateur(
            $id_user, $nom, $prenom, $email, 
            $this->utilisateur["password"], $this->utilisateur["status_connexion"], 
            $this->utilisateur["id_role"], $this->utilisateur["creer_le"], 
            $sexe, $ville, $pays, $bio, 
            $this->utilisateur["photo_profil"], $this->utilisateur["photo_couverture"]
        );
    
        // Enregistrer les modifications dans la base de données
        $this->utilisateurDAO->update($user);
    
        // Rediriger vers la page de profil
        header("Location: ../controleurs/profile.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    }

    // Publier un message sur le profil
    public function publierMessage($id_user, $contenu, $image) {
        // Créer une nouvelle publication
        $this->publicationDAO->create("", $contenu, $image);

        // Rediriger vers la page de profil
        header("Location: acceuil.php?action=profil&id=" . $id_user);
        exit();
    }

    // Déconnecter l'utilisateur
    public function deconnexion() {
        // Détruire la session
        session_destroy();

        // Rediriger vers la page de connexion
        header("Location: acceuil.php?action=connexion");
        exit();
    }
}

$con = new ProfilController();
$con->afficherProfil(1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $profil = new ProfilController();
    $profil->modifierProfil(1);
}

ob_end_flush(); // Envoie la sortie au navigateur
?>
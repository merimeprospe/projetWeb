<?php
ob_start(); // Active la mise en mémoire tampon 

class ProfilController
{
    private $conn;
    private $utilisateurDAO;
    private $publicationDAO;
    private $amieDAO;
    private $utilisateur;
    private $publications;
    private $messageDAO;

    public function __construct()
    {
        $con = new Data();
        $this->conn = $con->getconnection();
        $this->publicationDAO = new PublicationDAO($this->conn);
        $this->utilisateurDAO = new UtilisateurDAO($this->conn);
        $this->amieDAO = new AmieDAO($this->conn);
        $this->messageDAO = new MessageDAO($this->conn);
    }

    // Afficher le profil de l'utilisateur avec ses publications
    public function afficherProfil($id_user)
    {
        // Récupérer les informations de l'utilisateur
        $this->utilisateur = $this->utilisateurDAO->read($id_user);
        $utilisateur = $this->utilisateur;

        if (!$utilisateur) {
            // Gérer le cas où l'utilisateur n'existe pas
            header("Location: acceuil.php?action=erreur&message=Utilisateur non trouvé");
            exit();
        }

        // Récupérer les publications de l'utilisateur
        //$this->publications = $this->publicationDAO->afficherPublicationsByUser($id_user);
        //$publications = $this->publication;

        // afficher les publications


        $this->publications = $this->publicationDAO->afficherPublicationsByUser($id_user);
        $publications = $this->publications;

        // Récupérer les amis
        $amis = $this->amieDAO->findByDemandeurAndAmie($id_user);
        $friendsList = [];

        foreach ($amis as $ami) {
            if ($ami->decision == 1) {
                $friendId = ($ami->demandeur == $id_user) ? $ami->amie : $ami->demandeur;
                $friend = $this->utilisateurDAO->read($friendId);
                if ($friend) $friendsList[] = $friend;
            }
        }

        // Dans ProfilController::afficherProfil()
        $pendingRequests = $this->amieDAO->findPendingRequests($id_user);

        // Récupérer les photos de l'utilisateur
        $photos = $this->publicationDAO->getPhotosByUser($id_user);

        // Inclure la vue du profil
        include "pages/profile.php";
    }


    // Modifier le profil de l'utilisateur
    /*public function modifierProfil($id_user)
    {

        // Vérifier si l'utilisateur connecté est le propriétaire du profil
        if ($_SESSION['id'] != $id_user) {
            header("Location: routeur.php?action=profile&error=unauthorized");
            exit();
        }
        // Récupérer les données du formulaire
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $email = $_POST['email'] ?? null;
        $sexe = $_POST['sexe'] ?? null;
        $ville = $_POST['ville'] ?? null;
        $pays = $_POST['pays'] ?? null;
        $bio = $_POST['bio'] ?? null;
        $photo_profil = $_POST['photo_profil'] ?? null;
        $photo_couverture = $_POST['photo_couverture'] ?? null;

        // Récupérer l'utilisateur existant
        $this->utilisateur = $this->utilisateurDAO->read($id_user);


        // Mettre à jour les informations de l'utilisateur
        $user = new Utilisateur(
            $id_user,
            $nom,
            $prenom,
            $email,
            $this->utilisateur["password"],
            $this->utilisateur["status_connexion"],
            $this->utilisateur["id_role"],
            $this->utilisateur["creer_le"],
            $sexe,
            $ville,
            $pays,
            $bio,
            $photo_profil,
            $photo_couverture

        );

        // Enregistrer les modifications dans la base de données
        $this->utilisateurDAO->update($user);

        // Rediriger vers la page de profil
        header("Location: routeur.php?action=profile");
        exit(); // Assurez-vous de terminer le script après la redirection
    }*/

    public function modifierProfil($id_user)
    {
        // Vérifier que l'utilisateur est bien propriétaire
        if ($_SESSION['id'] != $id_user) {
            header("Location: routeur.php?action=profile&error=unauthorized");
            exit();
        }
       
        


        // Récupérer les données du formulaire (avec valeurs par défaut)
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : "Non spécifié";
        $ville = isset($_POST['ville']) ? $_POST['ville'] : "";
        $pays = isset($_POST['pays']) ? $_POST['pays'] : "";
        $bio = isset($_POST['bio']) ? $_POST['bio'] : "";

        // Gérer l'upload des photos (exemple pour photo_profil)
        $photo_profil = null;
        if (!empty($_FILES['photo']['tmp_name'])) {
            $photo_profil = file_get_contents($_FILES['photo']['tmp_name']);
        }

        $travail = isset($_POST['travail']) ? $_POST['travail'] : "";
        $loisirs = isset($_POST['loisirs']) ? $_POST['loisirs'] : "";

        $photo_couverture = null;
        if (!empty($_FILES['photo']['tmp_name'])) {
            $photo_couverture = file_get_contents($_FILES['photo']['tmp_name']);
        }

        // Créer un objet Utilisateur avec les nouvelles données
        $user = new Utilisateur(
            $id_user,
            $nom,
            $prenom,
            $email,
            "", // Password (non modifié ici)
            "", // Statut connexion (non modifié)
            1,  // Rôle par défaut (ajustez selon votre logique)
            date("Y-m-d H:i:s"), // Date de mise à jour
            $sexe,
            $ville,
            $pays,
            $bio,
            $photo_profil,
            $travail,
            $loisirs,
            $photo_couverture // Photo couverture (à implémenter si nécessaire)
        );

        // Mettre à jour la base de données
        $this->utilisateurDAO->update($user);

        // Rediriger vers le profil
        header("Location: routeur.php?action=profile&id=" . $id_user);
        exit();
    }

    // Publier un message sur le profil
    public function publierMessage($id_user, $contenu, $image)
    {
        // Créer une nouvelle publication
        $this->publicationDAO->create("", $contenu, $image);

        // Rediriger vers la page de profil
        header("Location: acceuil.php?action=profil&id=" . $id_user);
        exit();
    }

    // Envoyer un message
    public function envoyerMessage($id_expediteur, $id_destinataire, $contenu)
    {
        $id_message = null;

        // Générer la date actuelle au format MySQL
        $date_envoi = date("Y-m-d H:i:s");
        $message = new Message($id_message, $id_expediteur, $id_destinataire, $contenu, $date_envoi);


        if ($this->messageDAO->envoyerMessage($message)) {
            header("Location: routeur.php?action=conversation&id_expediteur=$id_expediteur&id_destinataire=$id_destinataire");
            exit();
        } else {
            echo "Erreur lors de l'envoi du message.";
        }
    }

    // Afficher la conversation
    public function afficherConversation($id_expediteur, $id_destinataire)
    {
        $messages = $this->messageDAO->getMessages($id_expediteur, $id_destinataire);
        $destinataire = $this->utilisateurDAO->read($id_destinataire);
        include "pages/messages_ami.php";
    }

    // Déconnecter l'utilisateur
    public function deconnexion()
    {
        // Détruire la session
        session_destroy();

        // Rediriger vers la page de connexion
        header("Location: acceuil.php?action=connexion");
        exit();
    }
}



//ob_end_flush(); // Envoie la sortie au navigateur

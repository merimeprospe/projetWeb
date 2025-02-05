<?php
// Ajout pour la gestion de la session
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "utils_inc/Data.php";
require_once "modules/DAO/PublicationDAO.php";
require_once "modules/DAO/GroupeDAO.php";
require_once "modules/DAO/MessageDAO.php";

class GroupController {
    private $groupeDAO;
    private $publicationDAO;
    private $messageDAO;

    public function __construct() {
        $con = new Data();
        $conn = $con->getconnection();

        $this->messageDAO = new MessageDAO($conn);
        $this->groupeDAO = new GroupeDAO($conn);
        $this->publicationDAO = new PublicationDAO($conn);
    }

    // Affiche la liste des groupes
    public function listes() {
        if (!isset($_SESSION['id'])) {
            echo "Erreur : utilisateur non connecté.";
            return;
        }

        // Récupérer les groupes et publications
        $groupes = $this->groupeDAO->getGroupesUtilisateur($_SESSION['id']); // Assurez-vous que cette méthode existe et renvoie les groupes
        $tabRes = $this->groupeDAO->getPublicationsDuGroupe($_SESSION['id'], $_SESSION['id_groupe']); // Assurez-vous que cette méthode existe et renvoie les publications
        $groupee = $this->groupeDAO->getGroupeParId($_SESSION['id_groupe']);
        $messages = $this->messageDAO->getMessagesByGroup($_SESSION['id_groupe']);
        // Charger la vue
        
        foreach ($groupes as &$groupe) {
            // Vérifier si l'utilisateur est membre du groupe
            $isMember = $this->groupeDAO->checkIfUserIsMember($_SESSION['id'], $groupe['id_groupe']);
            $groupe['est_membre'] = $isMember; // Ajouter un champ est_membre
        }
        // Eliminer les doublons dans $groupes en utilisant array_unique
        $groupes = array_map("unserialize", array_unique(array_map("serialize", $groupes)));
        require "pages/group.php";
    }

    // Fonction pour rejoindre un groupe
    public function joinGroup() {
        if (isset($_POST['id_groupe'])) {
            $id_groupe = $_POST['id_groupe'];

            // Vérifier si l'utilisateur est déjà membre
            if (isset($_SESSION['id'])) {
                $isMember = $this->groupeDAO->checkIfUserIsMember($_SESSION['id'], $id_groupe); // Implémenter cette méthode dans le modèle

                if (!$isMember) {
                    $this->groupeDAO->joinGroup($_SESSION['id'], $id_groupe); // Implémenter cette méthode dans le modèle pour ajouter l'utilisateur au groupe
                    
                } else {
                    echo "Vous êtes déjà membre de ce groupe.";
                }
            }
        }
    }
    public function searchGroups() {
        // Récupérer le texte de recherche s'il est défini (après suppression des espaces)
        $searchText = isset($_GET['search']) ? trim($_GET['search']) : "";
    
        // Si le champ n'est pas vide, rechercher par nom ; sinon, récupérer tous les groupes
        if ($searchText !== "") {
            $groupes = $this->groupeDAO->searchGroups($searchText);
        } else {
            $groupes = $this->groupeDAO->getTousLesGroupes();
        }
    
        // Afficher les résultats sous forme d'HTML
        foreach ($groupes as $groupe) {
            // Vérifier si l'utilisateur est membre du groupe
            $isMember = $this->groupeDAO->checkIfUserIsMember($_SESSION['id'], $groupe['id_groupe']);
    
            // Gestion de la photo du groupe
            $photoGroupe = !empty($groupe['photogroupe']) 
                ? 'data:image/jpeg;base64,' . base64_encode($groupe['photogroupe'])
                : 'assets/infos/R.jpeg'; // Photo générique par défaut
    
            // Afficher chaque groupe
            echo '<a class="profile group-item" href="routeur.php?action=profilGroupe&id_groupe=' . $groupe['id_groupe'] . '" onclick="setGroupeSession(' . $groupe['id_groupe'] . ')">
                    <div class="profile-photo group-photo">
                        <img src="' . $photoGroupe . '" alt="Photo du groupe">
                    </div>
                    <div class="card-body group-name">
                        <h5 class="card-title">' . htmlspecialchars($groupe['nom_groupe']) . '</h5>
                    </div>
                  </a>';
        }
    }
    


// Méthode pour quitter un groupe
public function quitGroup() {
    if (isset($_POST['id_groupe']) && isset($_SESSION['id'])) {
        $id_groupe = $_POST['id_groupe'];
        $id_user = $_SESSION['id'];

        // Retirer l'utilisateur du groupe
        $this->groupeDAO->quitGroup($id_user, $id_groupe);

    }
}
 // Méthode pour créer une publication dans le groupe actuel

 public function creerPublicationgroupe() {
    // Vérifier si les données du formulaire sont bien envoyées
    if (isset($_POST['id_groupe'], $_POST['id'], $_POST['titre'], $_POST['contenu'])) {
        $id_groupe = $_POST['id_groupe'];
        $id_utilisateur = $_POST['id'];
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $image = $_FILES['image']['name']; // Nom du fichier image

        // Insérer la publication dans la base de données
        $result = $this->publicationDAO->ajouterPublicationGroupe($id_groupe, $id_utilisateur, $titre, $contenu, $image);

        if ($result) {
            header("Location: routeur.php?action=mesGroupes"); // Redirection vers la page du groupe
            exit();
        } else {
            echo "Erreur lors de la publication.";
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}



    // Fonction pour mettre à jour la session avec l'ID du groupe
    public function setGroupeSession() {
        if (isset($_POST['id_groupe'])) {
            $_SESSION['id_groupe'] = $_POST['id_groupe']; // Stocker l'ID du groupe dans la session
            echo 'ID du groupe mis à jour dans la session';
        } else {
            echo 'Erreur: ID du groupe non spécifié';
        }
    }

    public function creerGroupe() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Vérification de la connexion utilisateur
                if (!isset($_SESSION['id'])) {
                    throw new Exception("Vous devez être connecté pour créer un groupe");
                }
                $id_admin = $_SESSION['id'];
    
                // Validation des données
                if (empty($_POST['nom_groupe'])) {
                    throw new Exception("Le nom du groupe est obligatoire");
                }
    
                // Création du groupe
                $groupId = $this->groupeDAO->creerGroupe(
                    $_POST['nom_groupe'],
                    $_POST['description'] ?? '',
                    $_FILES['group_image'] ?? null,
                    $id_admin
                );
    
                if (!$groupId) {
                    throw new Exception("Échec technique lors de la création du groupe");
                }
    
                // Ajout de l'admin comme membre
                if (!$this->groupeDAO->joinGroup($id_admin, $groupId)) {
                    throw new Exception("Le groupe a été créé mais l'ajout de l'admin a échoué");
                }
    
                // Vérification finale
                if (!$this->groupeDAO->checkIfUserIsMember($id_admin, $groupId)) {
                    throw new Exception("Création réussie mais vérification d'adhésion échouée");
                }
    
                // Redirection vers le profil du groupe
                header('Location: routeur.php?action=profilGroupe&id_groupe=' . $groupId);
                exit();
    
            } catch (Exception $e) {
                // Gestion des erreurs
                error_log("Erreur GroupController: " . $e->getMessage());
                $_SESSION['error'] = $e->getMessage();
                header('Location: routeur.php?action=creerGroupeForm');
                exit();
            }
        }
    }
    
    public function getNonMembers() {
        $groupId = $_GET['groupId'];
        $nonMembers = $this->groupeDAO->getUtilisateursNonMembres($groupId);
        header('Content-Type: application/json');
        echo json_encode($nonMembers);
        exit;
    }

    public function envoyerMessage() {
        if(isset($_SESSION['id'], $_POST['contenu'], $_POST['id_groupe'])) {
            $message = [
                'contenu' => $_POST['contenu'],
                'id_expediteur' => $_SESSION['id'],
                'id_groupe' => $_POST['id_groupe']
            ];
            
            $success = $this->messageDAO->creerMessage($message);
            echo json_encode(['success' => $success]);
            exit;
        }
    }


}
?>

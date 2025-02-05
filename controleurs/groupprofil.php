<?php
require_once "utils_inc/Data.php";
require_once 'modules/DAO/GroupeDAO.php';

class GroupprofilController {
    private $groupeDAO;
    
    public function __construct() {
        global $pdo;
        $this->groupeDAO = new GroupeDAO($pdo);
    }
    
    public function afficherProfilGroupe($id_groupe) {
        try {
            // Initialisation du tableau des données à transmettre à la vue
            $viewData = [
                'group'          => null,
                'admin'          => ['nom' => '', 'prenom' => ''],
                'members'        => [],
                'nonMembres'     => [],
                'publications'   => [],
                'showJoin'       => false,
                'showLeave'      => false,
                'showAdminPanel' => false
            ];
    
            // Récupération des infos du groupe (incluant les infos de l'administrateur)
            $group = $this->groupeDAO->getGroupWithAdmin($id_groupe);
            
            if ($group) {
                $viewData['group'] = $group;
                $viewData['admin'] = [
                    'nom'    => $group['admin_nom'] ?? 'Admin',
                    'prenom' => $group['admin_prenom'] ?? ''
                ];
                
                // Récupération complète des membres du groupe
                $viewData['members'] = $this->groupeDAO->getMembresCompletDuGroupe($id_groupe) ?? [];
                
                // Récupération des publications pour le groupe (si l'utilisateur est connecté)
                $user_id = $_SESSION['id'] ?? null;
                if ($user_id) {
                    $viewData['publications'] = $this->groupeDAO->getPublicationsDuGroupe($user_id, $id_groupe) ?? [];
                }
                
                // Si l'utilisateur connecté est l'administrateur, on récupère aussi la liste des non-membres
                if ($user_id && $this->groupeDAO->isUserGroupAdmin($user_id, $id_groupe)) {
                    $viewData['nonMembres'] = $this->groupeDAO->getUtilisateursNonMembres($id_groupe) ?? [];
                }
                
                // Détermination des actions à afficher selon le statut de l'utilisateur
                if ($user_id) {
                    $isMember = $this->groupeDAO->checkIfUserIsMember($user_id, $id_groupe);
                    $isAdmin  = $this->groupeDAO->isUserGroupAdmin($user_id, $id_groupe);
                    
                    $viewData['showJoin']       = !$isMember;
                    $viewData['showLeave']      = $isMember && !$isAdmin;
                    $viewData['showAdminPanel'] = $isAdmin;
                }
            }
    
            // Inclusion de la vue en transmettant le tableau $viewData
            require_once 'pages/groupprofil.php';
    
        } catch (Exception $e) {
            error_log($e->getMessage());
            die("Erreur lors du chargement du profil du groupe");
        }
    }
    public function ajouterMembre($id_groupe, $id_user) {
        // Vérifiez que l'utilisateur connecté est admin du groupe
        if (isset($_SESSION['id']) && $this->groupeDAO->isUserGroupAdmin($_SESSION['id'], $id_groupe)) {
            // Utilisation de la méthode du DAO pour ajouter le membre au groupe
            $this->groupeDAO->ajouterMembreGroupe($id_user, $id_groupe);
        }
        // Redirige vers le profil du groupe après l'ajout
        header("Location: routeur.php?action=profilGroupe&id_groupe=$id_groupe");
        exit();
    }
    
  
    public function joinGroup() {
        if (isset($_SESSION['id'], $_GET['id_groupe'])) {
            $id_groupe = $_GET['id_groupe'];
            if (!$this->groupeDAO->checkIfUserIsMember($_SESSION['id'], $id_groupe)) {
                $this->groupeDAO->joinGroup($_SESSION['id'], $id_groupe);
            }
            header("Location: routeur.php?action=profilGroupe&id_groupe=$id_groupe");
            exit();
        }
    }
    
    public function quitGroup() {
        if (isset($_SESSION['id'], $_GET['id_groupe'])) {
            $id_groupe = $_GET['id_groupe'];
            $this->groupeDAO->quitGroup($_SESSION['id'], $id_groupe);
            header('Location: routeur.php?action=accueil');
            exit();
        }
    }
    
    /**
     * Méthode centralisant les actions du groupe (modifier, supprimer, retirer un membre)
     */
    public function handleGroupActions($action, $id_groupe, $user_id = null) {
        try {
            // Vérification que l'utilisateur connecté est bien admin du groupe
            if (!$this->groupeDAO->isUserGroupAdmin($_SESSION['id'], $id_groupe)) {
                header("Location: routeur.php?action=profilGroupe&id_groupe=$id_groupe");
                exit();
            }
            
            switch ($action) {
                case 'update':
                    if (isset($_POST['nom_groupe'], $_POST['description'])) {
                        $this->groupeDAO->modifierGroupe(
                            $id_groupe,
                            $_POST['nom_groupe'],
                            $_POST['description']
                        );
                    }
                    break;
                
                case 'delete':
                    $this->groupeDAO->supprimerGroupe($id_groupe);
                    header('Location: routeur.php?action=accueil');
                    exit();
                    break;
                
                case 'removeMember':
                    if ($user_id) {
                        $this->groupeDAO->retirerMembre($user_id, $id_groupe);
                    }
                    break;
            }
            
            header("Location: routeur.php?action=profilGroupe&id_groupe=$id_groupe");
            exit();
            
        } catch (Exception $e) {
            error_log("Erreur handleGroupActions: " . $e->getMessage());
            die("Une erreur est survenue lors de l'opération.");
        }
    }
    
    public function retirerMembre($id_membre, $id_groupe) {
        if ($this->groupeDAO->isUserGroupAdmin($_SESSION['id'], $id_groupe)) {
            $this->groupeDAO->retirerMembre($id_membre, $id_groupe);
        }
        header("Location: routeur.php?action=profilGroupe&id_groupe=$id_groupe");
        exit();
    }
    
    public function modifierGroupe() {
        $id_groupe = $_POST['id_groupe'] ?? null;
        if ($id_groupe && $this->groupeDAO->isUserGroupAdmin($_SESSION['id'], $id_groupe)) {
            $this->groupeDAO->modifierGroupe(
                $id_groupe,
                $_POST['nom_groupe'] ?? '',
                $_POST['description'] ?? ''
            );
        }
        header("Location: routeur.php?action=profilGroupe&id_groupe=$id_groupe");
        exit();
    }
    
    public function supprimerGroupe($id_groupe) {
        if ($this->groupeDAO->isUserGroupAdmin($_SESSION['id'], $id_groupe)) {
            $this->groupeDAO->supprimerGroupe($id_groupe);
        }
        header('Location: routeur.php?action=accueil');
        exit();
    }

    public function supprimerPublication($id_publication) {
        try {
            global $pdo; // Vérifiez si vous avez bien $pdo disponible
    
            // Vérifier si l'utilisateur est connecté
            if (!isset($_SESSION['id'])) {
                throw new Exception("Utilisateur non connecté.");
            }
    
            // Récupérer la publication
            $publication = $this->groupeDAO->getPublicationById($id_publication);
            if (!$publication) {
                throw new Exception("Publication introuvable.");
            }
    
            $id_groupe = $publication['id_groupe']; // ID du groupe de la publication
            $isAdmin = $this->groupeDAO->isUserGroupAdmin($_SESSION['id'], $id_groupe);
            $isAuthor = ($_SESSION['id'] == $publication['id_auteur']);
    
            if (!$isAdmin && !$isAuthor) {
                throw new Exception("Permission refusée : Vous n'êtes ni admin ni auteur.");
            }
    
            // Suppression de la publication
            $success = $this->groupeDAO->supprimerPublication($id_publication);
            if (!$success) {
                throw new Exception("Échec de la suppression de la publication en base.");
            }
    
            // Redirection après suppression
            header("Location: routeur.php?action=profilGroupe&id_groupe=$id_groupe");
            exit();
        } catch (Exception $e) {
            error_log("Erreur suppression publication : " . $e->getMessage());
            die("Erreur : " . $e->getMessage()); // Affiche le message exact de l'erreur
        }
    }
    
    
}
?>

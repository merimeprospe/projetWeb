<?php
require_once __DIR__ . '/../modules/DAO/UtilisateurDAO.php';

class UserController {
    private $userDAO;

    public function __construct($pdo) {
        $this->userDAO = new UtilisateurDAO($pdo); // Corrected variable name
    }
    

    public function listUsers() {
        $users = $this->userDAO->findAllUsers();
        require_once __DIR__ . '/../pages/utilisateur.php';
    }


    public function suspendUser($id) {
        header('Content-Type: application/json'); // Assurez-vous que la réponse est bien en JSON

        if ($this->userDAO->suspendUser($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de la suspension']);
        }
        exit();
    }

    // ✅ Rechercher et filtrer les utilisateurs
    public function searchUsers() {
        header('Content-Type: application/json'); 

        $query = $_GET['query'] ?? '';
        $role = $_GET['role'] ?? 'all';

        $users = $this->userDAO->searchUsers($query, $role);

        echo json_encode($users);
        exit();
    }

    // ✅ Supprimer un utilisateur
    public function deleteUser() {
        header('Content-Type: application/json');

        $id_user = $_GET['id_user'] ?? null;

        if ($id_user) {
            $success = $this->userDAO->deleteUser($id_user);
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'error' => 'ID utilisateur manquant']);
        }
        exit();
    }

    // Mettre à jour un utilisateur
    public function updateUser() {
        header('Content-Type: application/json'); // 🔍 Vérifier la réponse JSON
        $data = $_POST; // ✅ Récupération des données correctement

        if (!isset($data['id_user'])) {
            echo json_encode(['success' => false, 'error' => 'ID utilisateur manquant']);
            exit();
        }

        $success = $this->userDAO->updateUser($data);

        echo json_encode([
            'success' => $success,
            'id_user' => $data['id_user'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'id_role' => $data['id_role'],
            'is_suspended' => $data['is_suspended'] ?? 0
        ]);
        exit();
    }


    public function getRoles() {
        header('Content-Type: application/json');

        try {
            $roles = $this->userDAO->getAllRoles();
            echo json_encode($roles);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Erreur lors du chargement des rôles', 'message' => $e->getMessage()]);
        }
        exit();
    }    
}
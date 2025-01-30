<?php
require_once '../utils_inc/Data.php'; 
require_once '../modules/Dao/UtilisateurDAO.php'; 

// Vérifiez si l'ID de l'utilisateur est transmis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    try {
        $data = new Data();
        $pdo = $data->getConnection();
        $utilisateurDAO = new UtilisateurDAO($pdo);

        // Mettez à jour l'utilisateur pour le suspendre
        $success = $utilisateurDAO->suspendUserById($userId);

        if ($success) {
            // Redirection vers le tableau de bord après la suspension
            header('Location: dashbord.php?message=suspension_success');
            exit;
        } else {
            echo "Erreur lors de la suspension de l'utilisateur.";
        }
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
} else {
    die("Requête invalide.");
}

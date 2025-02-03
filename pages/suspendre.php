<?php
require_once '../utils_inc/Data.php'; 
require_once '../modules/Dao/UtilisateurDAO.php'; 

// Vérifiez si un ID utilisateur est passé en paramètre
if (isset($_GET['id_user'])) {
    $userId = $_GET['id_user'];

    try {
        $data = new Data();
        $pdo = $data->getConnection();
        $utilisateurDAO = new UtilisateurDAO($pdo);

        // Récupérez les informations de l'utilisateur
        $user = $utilisateurDAO->findUserById($userId);

        if (!$user) {
            die("Utilisateur introuvable.");
        }
    } catch (PDOException $e) {
        die("Erreur PDO : " . $e->getMessage());
    }
} else {
    die("Aucun utilisateur spécifié.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suspendre Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .suspendre-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="suspendre-container">
        <h2>Suspendre l'Utilisateur</h2>
        <p>Êtes-vous sûr de vouloir suspendre l'utilisateur <strong><?= htmlspecialchars($user['nom']) . ' ' . htmlspecialchars($user['prenom']) ?></strong> ?</p>
        <p>Email : <em><?= htmlspecialchars($user['email']) ?></em></p>
        <div class="mt-4">
            <form action="process_suspend_user.php" method="post">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id_user']) ?>">
                <button type="submit" class="btn btn-primary">Suspendre</button>
            </form>
            <a href="dashbord.php" class="btn btn-secondary">Annuler</a>
        </div>
    </div>
</body>
</html>

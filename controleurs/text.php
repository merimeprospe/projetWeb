<?php
session_start();
require_once "../utils_inc/Data.php";
require_once "../modules/DAO/AmieDAO.php";
require_once "../modules/Entites/Amie.php";
require_once "../modules/DAO/NotificationDAO.php";
require_once "../modules/Entites/Notification.php";

class AmieManager {
    private $conn;
    private $amieDAO;
    private $notificationDAO;

    public function __construct() {
        $con = new Data();
        $this->conn = $con->getconnection();
        $this->amieDAO = new AmieDAO($this->conn);
        $this->notificationDAO = new NotificationDAO($this->conn);
    }

    public function sendFriendRequest($userId, $friendId) {
        $ami = new Amie();
        $ami->setDemandeur($userId);
        $ami->setAmie($friendId);
        $ami->setDate(date('Y-m-d H:i:s'));
        $ami->setDecision(false);

        $this->amieDAO->create($ami);

        $notification = new Notification();
        $notification->setUserId($friendId);
        $notification->setMessage("vous envoyer une demande d'amitié");
        $notification->setDate(date('Y-m-d H:i:s'));
        $notification->setIsRead(false);
        $notification->setSendUser($userId);

        $this->notificationDAO->addNotification($notification);
    }
}

if (isset($_GET["id"])) {
    $amieManager = new AmieManager();
    $amieManager->sendFriendRequest($_SESSION['id'], $_GET["id"]);
    echo "Demande d'amitié envoyée.";
} else {
    echo "ID de l'ami manquant.";
}

// Générer un sel aléatoire
$salt = password_hash('random_salt', PASSWORD_DEFAULT);

// Hasher le mot de passe avec le sel
$password_hash = password_hash('123456', PASSWORD_BCRYPT, ['salt' => $salt]);

// Vérifier un mot de passe
if (password_verify('123456', $password_hash)) {
  // Mot de passe correct
} else {
  // Mot de passe incorrect
}



// Validation des données reçues (exemple basique)
if (!isset($_GET['idUtil']) || !isset($_GET['nom']) || !isset($_GET['droits'])) {
    die("Erreur: Paramètres manquants.");
}

// Échapper les données pour prévenir les injections SQL
$idUtil = htmlspecialchars($_GET['idUtil'], ENT_QUOTES, 'UTF-8');
$nom = htmlspecialchars($_GET['nom'], ENT_QUOTES, 'UTF-8');
$droits = htmlspecialchars($_GET['droits'], ENT_QUOTES, 'UTF-8');

// Vérification de l'existence de l'utilisateur dans la base de données
// (à remplacer par votre propre requête SQL)
$pdo = new PDO('mysql:host=localhost;dbname=ma_base', 'mon_utilisateur', 'mon_mot_de_passe');
$stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = :id');
$stmt->execute([':id' => $idUtil]);
$utilisateur = $stmt->fetch();

if (!$utilisateur) {
    die("Utilisateur introuvable.");
}

// Sauvegarde des informations de l'utilisateur en session
$_SESSION['idUtil'] = $utilisateur['id'];
$_SESSION['nom'] = $utilisateur['nom'];
$_SESSION['droits'] = $utilisateur['droits'];

// Redirection vers la page de debug
header("Location: ../debugSession.php");
exit;

//Que fait l’instruction var_dump ?


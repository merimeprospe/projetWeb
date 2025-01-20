<?php
    session_start();
    require_once "../utils_inc/Data.php";
    require_once "../modules/DAO/AmieDAO.php";
    require_once "../modules/Entites/Amie.php";
    require_once "../modules/DAO/NotificationDAO.php";
    require_once "../modules/Entites/Notification.php";

    
    $con = new Data();
    $conn = $con->getconnection();
    $amieDAO = new AmieDAO($conn);
    
    $ami = new Amie();
    $ami->setDemandeur($_SESSION['id']);
    $ami->setAmie($_GET["id"]); // Exemple d'ID pour l'ami
    $ami->setDate(date('Y-m-d H:i:s')); // Date actuelle
    $ami->setDecision(false); // Décision (true pour acceptée, false pour refusée)

        
    // Créer une instance de Notification
    $notification = new Notification();
    $notification->setUserId($_GET["id"]);
    $notification->setMessage("vous envoyer une demande d'amitié");
    $notification->setDate(date('Y-m-d H:i:s'));
    $notification->setIsRead(false);
    $notification->setSendUser($_SESSION['id']);

    // Créer une instance de NotificationDAO
    $notificationDAO = new NotificationDAO($conn);

    // Ajouter la notification à la base de données
    $notificationDAO->addNotification($notification);
        
    echo "tttttttt000000000000tttttttttt"; // Ajout du point-virgule
    $amieDAO->create($ami);

?>

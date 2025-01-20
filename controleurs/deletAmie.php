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


    if ($_GET["action"]=="deletid") {
        $amieDAO->delete($_GET["id"]);
    }

 
    if ($_GET["action"]=="deletuser") {
        $amieDAO->delete1($_GET["id"],$_SESSION['id']);
        $id = $_GET["id"];
        echo "$id";

        // Créer une instance de Notification
        $notification = new Notification();
        $notification->setUserId($_GET["id"]);
        $notification->setMessage("a supprimer la demande d'amitié");
        $notification->setDate(date('Y-m-d H:i:s'));
        $notification->setIsRead(false);
        $notification->setSendUser($_SESSION['id']);

        // Créer une instance de NotificationDAO
        $notificationDAO = new NotificationDAO($conn);

        // Ajouter la notification à la base de données
        $notificationDAO->addNotification($notification);
    } 


    if ($_GET["action"]=="Accepter") {
        $amieDAO->Accepte($_GET["id"]);
    }

    
    


?>

<?php

class Routeur {
    private $conn;
    private $amieDAO;
    private $notificationDAO;

    public function __construct() {
        $con = new Data();
        $this->conn = $con->getconnection();
        $this->amieDAO = new AmieDAO($this->conn);
        $this->notificationDAO = new NotificationDAO($this->conn);
    }

    public function handleRequest() {
        if (isset($_GET["action"])) {
            switch ($_GET["action"]) {
                case "deletid":
                    $this->deleteAmie($_GET["id"]);
                    break;
                case "deletuser":
                    $this->deleteUser($_GET["id"], $_SESSION['id']);
                    break;
                case "Accepter":
                    $this->accepterAmie($_GET["id"]);
                    break;
                case "ajouter":
                    $this->sendFriendRequest($_GET["id"], $_SESSION['id']);
                    break;
                default:
                    echo "Action non reconnue.";
            }
        } else {
            echo "Aucune action spécifiée.";
        }
    }

    private function deleteAmie($id) {
        
        $this->amieDAO->delete($id);
        
        header("content-type: application/json");
        
        echo json_encode(["id" => $id]);

    }
    public function sendFriendRequest($friendId,$userId) {
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

    private function deleteUser($id, $sessionId) {
        $this->amieDAO->delete1($id, $sessionId);

        // Créer une instance de Notification
        $notification = new Notification();
        $notification->setUserId($id);
        $notification->setMessage("a supprimé la demande d'amitié");
        $notification->setDate(date('Y-m-d H:i:s'));
        $notification->setIsRead(false);
        $notification->setSendUser($sessionId);

        // Ajouter la notification à la base de données
        $this->notificationDAO->addNotification($notification);
    }

    private function accepterAmie($id) {

        $this->amieDAO->Accepte($id);

        header("content-type: application/json");
        
        echo json_encode(["id" => $id]);
    }
}




<?php

class NotificationDAO {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function addNotification($notification) {
        $query = "INSERT INTO notification (user_id, message, date, is_read, send_user) VALUES (:user_id, :message, :date, :is_read, :send_user)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            'user_id' => $notification->getUserId(),
            'message' => $notification->getMessage(),
            'date' => $notification->getDate(),
            'is_read' => $notification->getIsRead(),
            'send_user' => $notification->getSendUser(),
        ]);
    }

    public function getNotification($id) {
        $query = "SELECT * FROM notification WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $notification = new Notification();
            $notification->setId($row['id']);
            $notification->setUserId($row['user_id']);
            $notification->setMessage($row['message']);
            $notification->setDate($row['date']);
            $notification->setIsRead($row['is_read']);
            $notification->setSendUser($row['send_user']);
            return $notification;
        }
        return null;
    }

    public function getAllNotifications() {
        $notifications = [];
        $query = "SELECT * FROM notification";
        $stmt = $this->connection->query($query);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $notification = new Notification();
            $notification->setId($row['id']);
            $notification->setUserId($row['user_id']);
            $notification->setMessage($row['message']);
            $notification->setDate($row['date']);
            $notification->setIsRead($row['is_read']);
            $notification->setSendUser($row['send_user']);
            $notifications[] = $notification;
        }
        return $notifications;
    }

    public function updateNotification($notification) {
        $query = "UPDATE notification SET user_id = :user_id, message = :message, date = :date, is_read = :is_read, send_user = :send_user WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':user_id', $notification->getUserId());
        $stmt->bindParam(':message', $notification->getMessage());
        $stmt->bindParam(':date', $notification->getDate());
        $stmt->bindParam(':is_read', $notification->getIsRead(), PDO::PARAM_BOOL);
        $stmt->bindParam(':send_user', $notification->getSentUser());
        $stmt->bindParam(':id', $notification->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteNotification($id) {
        $query = "DELETE FROM notification WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getNotificationsByUserId($userId) {
        $query = "SELECT notification.*, utilisateur.*
                FROM notification
                JOIN utilisateur ON notification.send_user = utilisateur.id_user
                WHERE notification.user_id = :user_id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            'user_id' => $userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

}


?>

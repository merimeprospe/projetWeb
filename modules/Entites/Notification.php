<?php

class Notification {
    private $id;
    private $userId;
    private $message;
    private $date;
    private $isRead;
    private $sendUser;

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getIsRead() {
        return $this->isRead;
    }

    public function setIsRead($isRead) {
        $this->isRead = $isRead;
    }

    public function getSendUser() {
        return $this->sendUser;
    }

    public function setSendUser($sendUser) {
        $this->sendUser = $sendUser;
    }
}


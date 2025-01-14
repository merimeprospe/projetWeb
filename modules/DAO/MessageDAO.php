<?php

class MessageDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Message $message) {
        $stmt = $this->pdo->prepare('INSERT INTO Message (contenu, id_user, id_groupe, date_heure) VALUES (:contenu, :id_user, :id_groupe, :date_heure)');
        $stmt->execute([
            'contenu' => $message->getContenu(),
            'id_user' => $message->getIdUser(),
            'id_groupe' => $message->getIdGroupe(),
            'date_heure' => $message->getDateHeure()
        ]);
    }

    public function read($id_message) {
        $stmt = $this->pdo->prepare('SELECT * FROM Message WHERE id_message = :id_message');
        $stmt->execute(['id_message' => $id_message]);
        return $stmt->fetchObject('Message');
    }

    public function update(Message $message) {
        $stmt = $this->pdo->prepare('UPDATE Message SET contenu = :contenu, id_user = :id_user, id_groupe = :id_groupe, date_heure = :date_heure WHERE id_message = :id_message');
        $stmt->execute([
            'contenu' => $message->getContenu(),
            'id_user' => $message->getIdUser(),
            'id_groupe' => $message->getIdGroupe(),
            'date_heure' => $message->getDateHeure(),
            'id_message' => $message->getIdMessage()
        ]);
    }

    public function delete($id_message) {
        $stmt = $this->pdo->prepare('DELETE FROM Message WHERE id_message = :id_message');
        $stmt->execute(['id_message' => $id_message]);
    }
}

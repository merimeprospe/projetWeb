<?php

class MessageDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Envoyer un message
    public function envoyerMessage(Message $message)
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO messages_ami (id_expediteur, id_destinataire, contenu)
            VALUES (:id_expediteur, :id_destinataire, :contenu)
        ');
        return $stmt->execute([
            'id_expediteur' => $message->getIdExpediteur(),
            'id_destinataire' => $message->getIdDestinataire(),
            'contenu' => $message->getContenu()
        ]);
    }

    // Récupérer les messages entre deux utilisateurs
    public function getMessages($id_expediteur, $id_destinataire)
    {
        $stmt = $this->pdo->prepare('
            SELECT * FROM messages_ami
            WHERE (id_expediteur = :id_expediteur AND id_destinataire = :id_destinataire)
            OR (id_expediteur = :id_destinataire AND id_destinataire = :id_expediteur)
            ORDER BY date_envoi ASC
        ');
        $stmt->execute([
            'id_expediteur' => $id_expediteur,
            'id_destinataire' => $id_destinataire
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Marquer un message comme lu
    public function marquerCommeLu($id_message)
    {
        $stmt = $this->pdo->prepare('
            UPDATE messages_ami SET lu = 1 WHERE id_message = :id_message
        ');
        return $stmt->execute(['id_message' => $id_message]);
    }
}

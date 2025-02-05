<?php
class MessageDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getMessagesByGroup($groupId) {
        $stmt = $this->pdo->prepare('
            SELECT 
                m.contenu,
                m.date_heure,
                u.prenom AS expediteur_prenom,
                u.nom AS expediteur_nom
            FROM message m
            JOIN utilisateur u ON m.id_expediteur = u.id_user
            WHERE m.id_groupe = :groupId
            ORDER BY m.date_heure ASC
        ');
        $stmt->execute(['groupId'=>$groupId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creerMessage($messageData) {
        try {
            $stmt = $this->pdo->prepare('
                INSERT INTO message 
                (contenu, id_expediteur, id_groupe, date_heure)
                VALUES (:contenu, :id_expediteur, :id_groupe, NOW())
            ');
            
            return $stmt->execute([
                ':contenu' => $messageData['contenu'],
                ':id_expediteur' => $messageData['id_expediteur'],
                ':id_groupe' => $messageData['id_groupe']
            ]);
            
        } catch (PDOException $e) {
            error_log("Erreur MessageDAO: " . $e->getMessage());
            return false;
        }
    }
}
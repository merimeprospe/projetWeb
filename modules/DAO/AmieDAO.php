<?php



class AmieDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Amie $amie) {
        $stmt = $this->pdo->prepare('INSERT INTO amies (demandeur, amie, date, decision) VALUES (:demandeur, :amie, :date, :decision)');
        $stmt->execute([
            'demandeur' => $amie->getDemandeur(),
            'amie' => $amie->getAmie(),
            'date' => $amie->getDate(),
            'decision' => $amie->getDecision()
        ]);
        $amie->setId($this->pdo->lastInsertId());
    }

    public function read($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM amies WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject('Amie');
    }

    public function update(Amie $amie) {
        $stmt = $this->pdo->prepare('UPDATE amies SET demandeur = :demandeur, amie = :amie, date = :date, decision = :decision WHERE id = :id');
        $stmt->execute([
            'demandeur' => $amie->getDemandeur(),
            'amie' => $amie->getAmie(),
            'date' => $amie->getDate(),
            'decision' => $amie->getDecision(),
            'id' => $amie->getId()
        ]);
    }

    public function Accepte($id) {
        $stmt = $this->pdo->prepare('UPDATE amies SET decision = :decision WHERE id = :id');
        $stmt->execute([
            'decision' => true,
            'id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM amies WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function delete1($id,$id1) {
        $stmt = $this->pdo->prepare('DELETE FROM amies WHERE amie = :id and demandeur = :id1');
        $stmt->execute(['id' => $id,'id1' => $id1]);
    }


    public function findAll() {
        $stmt = $this->pdo->query('SELECT * FROM amies');
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Amie');
    }

    public function findAlldemande($id) {
        $stmt = $this->pdo->prepare('SELECT amies.*, utilisateur.*
                                    FROM amies
                                    JOIN utilisateur ON amies.demandeur = utilisateur.id_user
                                    WHERE amies.amie = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    // Nouvelle méthode pour récupérer un ami en fonction de demandeur et amie
    public function findByDemandeurAndAmie($demandeur) {
        $stmt = $this->pdo->prepare('SELECT * FROM amies WHERE (demandeur = :demandeur) OR (amie = :demandeur)');
        $stmt->execute([
            'demandeur' => $demandeur
        ]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }


    /////////////////

    public function deleteFriendRelation($userId, $friendId) {
        $stmt = $this->pdo->prepare('
            DELETE FROM amies 
            WHERE (demandeur = :user AND amie = :friend) 
            OR (demandeur = :friend AND amie = :user)
        ');
        $stmt->execute([
            'user' => $userId,
            'friend' => $friendId
        ]);
    }

    public function findPendingRequests($userId) {
        $stmt = $this->pdo->prepare('
            SELECT * FROM amies 
            WHERE amie = :userId 
            AND decision = 0
        ');
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }





}
?>

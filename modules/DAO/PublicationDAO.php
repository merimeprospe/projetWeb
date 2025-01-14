<?php

class PublicationDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Publication $publication) {
        $stmt = $this->pdo->prepare('INSERT INTO Publication (contenu, id_user, id_groupe) VALUES (:contenu, :id_user, :id_groupe)');
        $stmt->execute([
            'contenu' => $publication->getContenu(),
            'id_user' => $publication->getIdUser(),
            'id_groupe' => $publication->getIdGroupe()
        ]);
    }

    public function read($id_pub) {
        $stmt = $this->pdo->prepare('SELECT * FROM Publication WHERE id_pub = :id_pub');
        $stmt->execute(['id_pub' => $id_pub]);
        return $stmt->fetchObject('Publication');
    }

    public function update(Publication $publication) {
        $stmt = $this->pdo->prepare('UPDATE Publication SET contenu = :contenu, id_user = :id_user, id_groupe = :id_groupe WHERE id_pub = :id_pub');
        $stmt->execute([
            'contenu' => $publication->getContenu(),
            'id_user' => $publication->getIdUser(),
            'id_groupe' => $publication->getIdGroupe(),
            'id_pub' => $publication->getIdPub()
        ]);
    }

    public function delete($id_pub) {
        $stmt = $this->pdo->prepare('DELETE FROM Publication WHERE id_pub = :id_pub');
        $stmt->execute(['id_pub' => $id_pub]);
    }
}

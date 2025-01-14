<?php

class GroupeDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Groupe $groupe) {
        $stmt = $this->pdo->prepare('INSERT INTO Groupe (nom_groupe, description, id_admin) VALUES (:nom_groupe, :description, :id_admin)');
        $stmt->execute([
            'nom_groupe' => $groupe->getNomGroupe(),
            'description' => $groupe->getDescription(),
            'id_admin' => $groupe->getIdAdmin()
        ]);
    }

    public function read($id_groupe) {
        $stmt = $this->pdo->prepare('SELECT * FROM Groupe WHERE id_groupe = :id_groupe');
        $stmt->execute(['id_groupe' => $id_groupe]);
        return $stmt->fetchObject('Groupe');
    }

    public function update(Groupe $groupe) {
        $stmt = $this->pdo->prepare('UPDATE Groupe SET nom_groupe = :nom_groupe, description = :description, id_admin = :id_admin WHERE id_groupe = :id_groupe');
        $stmt->execute([
            'nom_groupe' => $groupe->getNomGroupe(),
            'description' => $groupe->getDescription(),
            'id_admin' => $groupe->getIdAdmin(),
            'id_groupe' => $groupe->getIdGroupe()
        ]);
    }

    public function delete($id_groupe) {
        $stmt = $this->pdo->prepare('DELETE FROM Groupe WHERE id_groupe = :id_groupe');
        $stmt->execute(['id_groupe' => $id_groupe]);
    }
}

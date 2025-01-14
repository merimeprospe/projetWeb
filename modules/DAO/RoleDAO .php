<?php

class RoleDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create(Role $role) {
        $stmt = $this->pdo->prepare('INSERT INTO Role (nom_role) VALUES (:nom_role)');
        $stmt->execute(['nom_role' => $role->getNomRole()]);
    }

    public function read($id_role) {
        $stmt = $this->pdo->prepare('SELECT * FROM Role WHERE id_role = :id_role');
        $stmt->execute(['id_role' => $id_role]);
        return $stmt->fetchObject('Role');
    }

    public function update(Role $role) {
        $stmt = $this->pdo->prepare('UPDATE Role SET nom_role = :nom_role WHERE id_role = :id_role');
        $stmt->execute(['nom_role' => $role->getNomRole(), 'id_role' => $role->getIdRole()]);
    }

    public function delete($id_role) {
        $stmt = $this->pdo->prepare('DELETE FROM Role WHERE id_role = :id_role');
        $stmt->execute(['id_role' => $id_role]);
    }
}

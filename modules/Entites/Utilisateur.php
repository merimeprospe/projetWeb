<?php
require_once "../utils_inc/Data.php";
class Utilisateur {
    private $id_user;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $status_connexion;
    private $id_role;
    private $creer_le;
    private $sexe;
    private $ville;
    private $pays;
    private $bio;
    private $photo_profil;
    private $photo_couverture;


    public function __construct(
        $id_user = null,
        $nom = null,
        $prenom = null,
        $email = null,
        $password = null,
        $status_connexion = 'offline',
        $id_role = null,
        $creer_le = null,
        $sexe = null,
        $ville = null,
        $pays = null,
        $bio = null,
        $photo_profil = null,
        $photo_couverture = null
    ) {
        $this->id_user = $id_user;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->status_connexion = $status_connexion;
        $this->id_role = $id_role;
        $this->creer_le = isset($creer_le) ? $creer_le : date('Y-m-d H:i:s');
        $this->sexe = $sexe;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->bio = $bio;
        $this->photo_profil = $photo_profil;
        $this->photo_couverture = $photo_couverture;
    }

    // Getters
    public function getIdUser() {
        return $this->id_user;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getStatusConnexion() {
        return $this->status_connexion;
    }

    public function getIdRole() {
        return $this->id_role;
    }

    public function getCreer_Le() {
        return $this->creer_le;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getPays() {
        return $this->pays;
    }

    public function getBio() {
        return $this->bio;
    }

    public function getPhotoProfil() {
        return $this->photo_profil;
    }
    public function getPhotoCouverture() {
        return $this->photo_couverture;
    }

    // Setters
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new InvalidArgumentException("Email invalide.");
        }
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setStatusConnexion($status_connexion) {
        if (in_array($status_connexion, ['online', 'offline', 'inactif'])) {
            $this->status_connexion = $status_connexion;
        } else {
            throw new InvalidArgumentException("Statut de connexion invalide.");
        }
    }

    public function setIdRole($id_role) {
        $this->id_role = $id_role;
    }

    public function setCreerLe($creer_le) {
        $this->creer_le = $creer_le;
    }

    public function setSexe($sexe) {
        if (in_array($sexe, ['Homme', 'Femme', ''])) {
            $this->sexe = $sexe;
        } else {
            throw new InvalidArgumentException("Sexe invalide.");
        }
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setPays($pays) {
        $this->pays = $pays;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    public function setPhotoProfil($photo_profil) {
        $this->photo_profil = $photo_profil;
    }
    public function setPhotoCouverture($photo_couverture) {
        $this->photo_couverture = $photo_couverture;
    }
}
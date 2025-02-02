<?php
// Publication.php (Entité)
class Publication {
    private $id_pub;
    private $contenu;
    private $id_user;
    private $id_groupe;
    private $created_at;
    private $updated_at;
    private $Titre;
    private $photo;
    private $is_visible;

    public function __construct($id_pub, $contenu, $id_user, $id_groupe, $created_at = null, $updated_at = null, $Titre = null, $photo = null, $is_visible = 1) {
        $this->id_pub = $id_pub;
        $this->contenu = $contenu;
        $this->id_user = $id_user;
        $this->id_groupe = $id_groupe;
        $this->created_at = $created_at ?: date('Y-m-d H:i:s');
        $this->updated_at = $updated_at ?: date('Y-m-d H:i:s');
        $this->Titre = $Titre;
        $this->photo = $photo;
        $this->is_visible = $is_visible;
    }

    public function getIdPub() { return $this->id_pub; }
    public function getContenu() { return $this->contenu; }
    public function getIdUser() { return $this->id_user; }
    public function getIdGroupe() { return $this->id_groupe; }
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
    public function getTitre() { return $this->Titre; }
    public function getPhoto() { return $this->photo; }
    public function getIsVisible() { return $this->is_visible; }

    public function setContenu($contenu) { $this->contenu = $contenu; }
    public function setIdUser($id_user) { $this->id_user = $id_user; }
    public function setIdGroupe($id_groupe) { $this->id_groupe = $id_groupe; }
    public function setTitre($Titre) { $this->Titre = $Titre; }
    public function setPhoto($photo) { $this->photo = $photo; }
    public function setIsVisible($is_visible) { $this->is_visible = $is_visible; }
}
<?php

class Message
{
    private $id_message;
    private $id_expediteur;
    private $id_destinataire;
    private $contenu;
    private $date_envoi;
    private $lu;

    public function __construct($id_message, $id_expediteur, $id_destinataire, $contenu, $date_envoi)
    {
        $this->id_message = $id_message;
        $this->id_expediteur = $id_expediteur;
        $this->id_destinataire = $id_destinataire;
        $this->contenu = $contenu;
        $this->date_envoi = $date_envoi;
    }
    // Getters et setters
    public function getIdMessage()
    {
        return $this->id_message;
    }
    public function getIdExpediteur()
    {
        return $this->id_expediteur;
    }
    public function getIdDestinataire()
    {
        return $this->id_destinataire;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function getDateEnvoi()
    {
        return $this->date_envoi;
    }
    public function getLu()
    {
        return $this->lu;
    }

    public function setIdMessage($id_message)
    {
        $this->id_message = $id_message;
    }
    public function setIdExpediteur($id_expediteur)
    {
        $this->id_expediteur = $id_expediteur;
    }
    public function setIdDestinataire($id_destinataire)
    {
        $this->id_destinataire = $id_destinataire;
    }
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
    public function setDateEnvoi($date_envoi)
    {
        $this->date_envoi = $date_envoi;
    }
    public function setLu($lu)
    {
        $this->lu = $lu;
    }
}

<?php

class Amie {
    private $id;
    private $demandeur;
    private $amie;
    private $date;
    private $decision;

    // Getters
    public function getId() {
        return $id;
    }

    public function getDemandeur() {
        return $this->demandeur;
    }

    public function getAmie() {
        return $this->amie;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDecision() {
        return $this->decision;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setDemandeur($demandeur) {
        $this->demandeur = $demandeur;
    }

    public function setAmie($amie) {
        $this->amie = $amie;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setDecision($decision) {
        $this->decision = $decision;
    }
}
?>

<?php

    function estConnecte(){
        return isset($_SESSION["droit"]);
    }

    function aDroit($nomDroit){
        return isset($_SESSION["droit"]) && $_SESSION["droit"]==$nomDroit;
    }
<?php
    session_start();
    require_once "utils_inc/inc_pdo.php";
    require_once "utils_inc/inc_verifsDroits.php";


    // syntaxe attendue : router.php?action=monAction&param1=valeurA&param2=valeurB...
    
    // page de connextion : routeur sans action
    if (!isset($_GET["action"])){
        // => accueil;
        require "vues/formCo.php";
        exit();
    } 


    if ($_GET["action"]=="accueil"){
        require_once "controleurs/accueil.php";
        exit();
    }


    if ($_GET["action"]=="traiterAuthentification"){
        require_once "controleurs/controleurLogin.php";
        login();
        exit(); // inutile ici puisque le login redirige, mais plus tranquilisant à la relecture de ce fichier seul
    }


    if ($_GET["action"]=="toutesContribs"){
        require_once "controleurs/controleurContribs.php";

        if (!estConnecte()){
            header("location:routeur.php"); // => connection
            exit();
        }else{
            listerToutesContribs(); // fonction située dans le controleur, c'est elle qui apelle (inclut) la vue
        }
        //if (!aDroit("admin")) {
        //    header("location:vues/accueil.php");
        //    exit();
       // }

        exit();
    }
    if ($_GET["action"]=="toutesMembre"){
        require_once "controleurs/controleurMembre.php";

        if (!estConnecte()){
            header("location:routeur.php"); // => connection
            exit();
        }else{
            listerToutesMembre(); // fonction située dans le controleur, c'est elle qui apelle (inclut) la vue
        }
        //if (!aDroit("admin")) {
        //    header("location:vues/accueil.php");
        //    exit();
       // }

        exit();
    }

    die("tutépomé ?");
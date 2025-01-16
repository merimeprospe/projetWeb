<?php

    require_once "utils_inc/Data.php";
    require_once "modules/DAO/PublicationDAO.php"; 



    function listes(){
    
        // on appelle la vue

        $con = new Data();
        $conn = $con->getconnection();
        $publication = new PublicationDAO($conn);

        $tabRes = $publication->afficherPublications();

        require "pages/accueil.php";
    }


<?php

require_once "../utils_inc/Data.php";
require_once "../modules/DAO/PublicationDAO.php";
require_once "../modules/DAO/GroupeDAO.php";



    function __construct($pdo) {
        $con = new Data () ;
        $conn = $con -> getconnection ();
   
        $groupe = new GroupeDAO($pdo);
        $publication = new PublicationDAO($conn);

        $tabRes = $publication->afficherPublicationsGroupe();

    
}
?>

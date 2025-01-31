<?php
    session_start();
    require_once "utils_inc/inc_verifsDroits.php";
    require_once "utils_inc/Data.php";
    require_once "modules/DAO/UtilisateurDAO.php";
    require_once "modules/DAO/AmieDAO.php";
    require_once "modules/Entites/Amie.php";
    require_once "modules/DAO/PublicationDAO.php";
    require_once "modules/DAO/NotificationDAO.php";
    require_once "modules/Entites/Notification.php";


    // syntaxe attendue : router.php?action=monAction&param1=valeurA&param2=valeurB...
    
    // page de connextion : routeur sans action
    if (!isset($_GET["action"])){
        // => accueil;
        require "vues/formCo.php";
        exit();
    } 

    if ($_GET["action"]=="login"){
        require_once "controleurs/login.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST["login"];
            $pass = $_POST["pass"];
            $authController = new AuthController();
            $authController->authenticate($login, $pass);
        }
        exit();
    }
    if ($_GET["action"]=="poste"){
        require_once "controleurs/poste.php";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $publication = new Publication();
            $publication->ajouterPublication($_POST['titre'], $_POST['contenu'], $_FILES['image']);
        }

        exit();
    }

    if ($_GET["action"]=="accueil"){
        require_once "controleurs/accueil.php";
        // Exemple d'utilisation de la classe
        $controller = new PublicationController();
        $controller->listes();
        exit();
    }

    if ($_GET["action"]=="amie"){
        require_once "controleurs/amie.php";
        $controller = new AmieController();
        $controller->listes();
        exit();
    }
    
    if ($_GET["action"]=="deletid"){
        require_once "controleurs/deletAmie.php";
        $routeur = new Routeur();
        $routeur->handleRequest();
        exit();
    }

    if ($_GET["action"]=="deletuser"){
        require_once "controleurs/deletAmie.php";
        $routeur = new Routeur();
        $routeur->handleRequest();
        exit();
    }
    
    if ($_GET["action"]=="Accepter"){
        require_once "controleurs/deletAmie.php";
        $routeur = new Routeur();
        $routeur->handleRequest();
        exit();
    }

        
    if ($_GET["action"]=="ajouter"){
        require_once "controleurs/deletAmie.php";
        $routeur = new Routeur();
        $routeur->handleRequest();
        exit();
    }

    // Exemple de routeur
   // $action = $_GET['action'] ?? 'accueil';

    switch ($action) {
        case 'profil':
            $id_user = $_GET['id'];
            if ($id_user) {
                $controller = new ProfilController();
                $controller->afficherProfil($id_user);
            } else {
                die("ID utilisateur manquant.");
            }
            break;
        // Autres cas...
    }



    /* if ($_GET["action"]=="traiterAuthentification"){
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

 */    die("tutépomé ?");
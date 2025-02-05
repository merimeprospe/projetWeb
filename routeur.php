<?php
session_start();
require_once "utils_inc/inc_pdo.php";
require_once "utils_inc/inc_verifsDroits.php";

// Syntaxe attendue : routeur.php?action=monAction&param1=valeurA&param2=valeurB...


if ($_GET["action"] == "accueil") {
    require_once "controleurs/accueil.php";
    exit();
}


if ($_GET["action"] == "mesGroupes" && isset($_GET['id_groupe'])) {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->listes();
    $_SESSION['id_groupe'] = $_GET['id_groupe'];
    exit();
}



// Affichage du profil d'un groupe
if ($_GET["action"] == "profilGroupe" && isset($_GET['id_groupe'])) {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->afficherProfilGroupe($_GET['id_groupe']);
    exit();
}



// Rechercher un groupe
if ($_GET["action"] == "searchGroups") {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->searchGroups();
    exit();
}

// Définir la session du groupe
if ($_GET["action"] == "setGroupeSession") {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->setGroupeSession();
    exit();
}


// Rechercher un groupe
if ($_GET["action"] == "searchGroups") {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->searchGroups();
    exit();
}

// Définir la session du groupe
if ($_GET["action"] == "setGroupeSession") {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->setGroupeSession();
    exit();
}

if ($_GET["action"] == "profilGroupe" && isset($_GET['id_groupe'])) {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->afficherProfilGroupe($_GET['id_groupe']);
    exit();
}

if (isset($_GET['groupAction'])) {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->handleGroupActions(
        $_GET['groupAction'],
        $_GET['id_groupe'],
        $_GET['user_id'] ?? null
    );
}
if ($_GET["action"] == "joinGroup" && isset($_GET['id_groupe'])) {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $_SESSION['id_groupe'] = $_GET['id_groupe'];
    $controller->joinGroup();
    
    exit();
}

// Route pour quitter un groupe
if ($_GET["action"] == "quitGroup" && isset($_GET['id_groupe'])) {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->quitGroup();
    $_SESSION['id_groupe'] = $_GET['id_groupe'];
    exit();
}
// Gestion admin
if ($_GET["action"] == "retirerMembre") {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->retirerMembre($_GET['id_membre'], $_GET['id_groupe']);
    exit();
}

if ($_GET["action"] == "modifierGroupe") {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->modifierGroupe();
    exit();
}

if ($_GET["action"] == "supprimerGroupe") {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->supprimerGroupe($_GET['id_groupe']);
    exit();
}
// Gestion admin


if ($_GET["action"] == "ajouterMembre") {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->ajouterMembre( $_GET['id_groupe'], $_GET['id_user']);
    exit();
}



// Route pour supprimer une publication
if ($_GET["action"] == "supprimerPublication" && isset($_GET['id_publication'])) {
    require_once "controleurs/groupprofil.php";
    $controller = new GroupprofilController();
    $controller->supprimerPublication($_GET['id_publication']);
    exit();
}
 
if ($_GET["action"] == "creerGroupe") {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->creerGroupe();
    exit();
}

if ($_GET["action"] == "getNonMembers") {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->getNonMembers();
    exit();
}

if ($_GET["action"] == "envoyerMessage") {
    require_once "controleurs/group.php";
    $controller = new GroupController();
    $controller->envoyerMessage();
    exit();
}


die("tutépomé ?");
?>

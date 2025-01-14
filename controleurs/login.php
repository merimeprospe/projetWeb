<?php
    session_start();
    require_once "../utils_inc/Data.php"; // $pdo existe ici désormais
    // http://localhost/contribs/traiterAuthentification.php?login=M001&pass=123

    // Recevoir les données du form de login, et vérifier login/pass dans la base
    // En version finale : envoi en $_POST obligatoire. Pour le dev $_GET peut être plus pratique.

    $conn = new Data();
    $con = $conn->getconnection();
    $login = $_POST["login"];
    $pass = $_POST["pass"];
    echo "  <th>".$login."</th>";

    //echo "  <th>".$con."</th>";
    // Vérification dans la base si le mot de passe et le login se trouvent dans la base
    // VERSION mot de passe en clair 

    $textR = "select id_role ";
    $textR.= "from utilisateur ";
    $textR.= "where id_user=:login and password=:pass ";
    $req = $con->prepare($textR);
    $req->bindParam(":login", $login);
    $req->bindParam(":pass", $pass);
    $req->execute();

    // 2 possibilités : 1 ligne retournée ou 0 ligne retournée 
    $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);
    $str = var_export($tabRes, true);

   if (count($tabRes)!=1) {
    
        // pas trouvé => retour au formulaire de co
        // die("Erreur de co");
        echo "  <th>".$str."</th>";
        exit();
    }

    // Si on arrive là : login/pass OK (count==1)
    // Stockage en session : 

    $_SESSION["login"] = $login;
    //$_SESSION["droit"] = $tabRes[0]["droit"]; // TODO : EXPLIQUER (erreur en séance)

    // redirection vers accueil, éventuellement spécifique à l'utilisateur

    header("Location:../pages/accueil.php");
   
    // pas besoin d'exit pour déclencher la redirection, puisque fin de script



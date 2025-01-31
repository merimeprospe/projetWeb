<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="css/accueil_.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .user-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 90px;
        }
        .user-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
            padding: 20px;
            text-align: left;
            width: 100%;
            max-width: 600px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .user-card img {
            border-radius: 50%;
            height: 100px;
            width: 100px;
            margin-right: 20px;
        }
        .user-info {
            flex-grow: 1;
        }
        .user-info h3 {
            margin: 0;
        }
        .user-info p {
            margin: 5px 0 0;
            color: #888;
        }
        .action {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-primary {
            background-color:  #0998c1;
            color: #fff;
        }
        .btn-secondary {
            background-color: #e96743;
            color: #fff;
        }
    </style>

    <!-- Inclusion de jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        function Demande(id,n) {
            console.log("btn"+n+id);
            
            if (document.getElementById("btn"+n+id).innerHTML == "Annuler") {
                console.log("okokok");
                
                $.get("routeur.php?id="+id+"&action=deletuser", traiterReponseDemande01(id,n));
                
            } else {
                $.get("routeur.php?id="+id+"&action=ajouter", traiterReponseDemande01(id,n));
                
            }
        }

        function traiterReponseDemande01(donnees)
{
    console.log(donnees);

    $("#unMessage").html(donnees);
}

        
        function traiterReponseDemande01(id,n) {
            if (document.getElementById("btn"+n+id).innerHTML == "Annuler") {
                document.getElementById("btn"+n+id).innerHTML = "Ajoutez"
                document.getElementById("btn"+n+id).className  = "btn btn-primary"
            } else {
                document.getElementById("btn"+n+id).innerHTML = "Annuler"
                document.getElementById("btn"+n+id).className  = "btn btn-secondary"
                
            }
        }

        function appelerControleur() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "controleurs/amie.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("resultat").innerHTML = xhr.responseText;
                }
            };

            xhr.send("action=simpleFunction");
        }

        function rediriger() {
            window.location.href = "routeur.php?action=accueil";
        }

        function search() {
            if (document.getElementById("search").value) {
                console.log(document.getElementById("search").value);
                window.location.href = "routeur.php?action=amie&val="+document.getElementById("search").value;
                //window.location.href = "controleurs/amie.php?val=" + document.getElementById("search").value;
            }
        }
    </script>
</head>

<body>

    <nav>
        <div class="container">
            <div class="logo" onclick="rediriger()">
                <img src="assets/images/logo.jpg" style="width: 10%; height: 10%;">
                <h2 class="log">
                    Social
                </h2>
            </div>
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Search for inspiration and projects..." id="search">
            </div>
            <div class="create">
                <label class="btn btn-primary" for="create post" onclick="search()">Create</label>
                <div class="profile-photo">
                    <img src="assets/infos/R.jpeg">
                </div>
            </div>
        </div>
    </nav>

    <div class="user-list">
        <!-- Ajoutez plus de cartes utilisateur ici -->
        <?php
            foreach($tabRes as $uneLigne) {
                if ($uneLigne->id_user != $_SESSION['id'] ) {
                ?>
            <div class="user-card">
                <img src="assets/infos/R.jpeg" alt="User 2">
                <div class="user-info">
                    <h3><?php echo $uneLigne->nom ?></h3>
                    <h5><?php echo $uneLigne->prenom ?></h5>
                    <p>8 amis en commun</p>
                </div>
                <div class="action">
                <?php
                    $n = 0;
                     foreach($amis as $uneLign) {
                        if ($uneLigne->id_user == $uneLign->amie || $uneLigne->id_user == $uneLign->demandeur) {
                            $n = 1;
                            if ($uneLign->amie!= $_SESSION['id']){

                            
                            if ($uneLign->decision==true) {?>
                                <button class="btn btn-secondary">Message</button>
                        <?php
                            }else{
                                ?>
                                <button id="<?php echo 'btn2' . $uneLigne->id_user ?>"   class="btn btn-secondary" onclick="Demande(<?php echo $uneLigne->id_user?>,'2')">Annuler</button>
                        <?php
                            }
                        }else{
                            {?>
                                <button class="btn btn-secondary">En Attend</button>
                        <?php
                        }}
                    }}
                ?>
                <?php if($n==0){ ?>
                    <button id="<?php echo 'btn1' . $uneLigne->id_user ?>"
                    class="btn btn-primary" onclick="Demande(<?php echo $uneLigne->id_user ?>,'1')">Ajoutez</button>
                    <?php } ?>
                </div>
            </div>
        <?php
            }}
        ?>  
   <!--  <button onclick="appelerControleur()">Appeler Fonction</button>
    <div id="resultat"></div> -->
</body>

</html>

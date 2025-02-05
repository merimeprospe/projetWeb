<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TMF's Social Media</title>
        <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
        <meta name="description" content="TMF's Social Media">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/accueil_.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
        <style>
            /* Ajouts pour les modals */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            }

            .modal-content {
                background-color: #fff;
                margin: 5% auto;
                padding: 25px;
                width: 90%;
                max-width: 600px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            }

            .modal-header {
                border-bottom: 1px solid #eee;
                padding-bottom: 15px;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
            }

            .input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }

            /* Styles existants conservés */
            .group-item {
                display: flex;
                align-items: center;
                text-decoration: none;
                margin: 10px 0;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
                transition: background-color 0.3s ease;
            }

            .group-item:hover {
                background-color: rgb(213, 247, 248);
            }

            .group-photo {
                width: 50px;
                height: 50px;
                margin-right: 15px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .group-photo img {
                width: 100%;
                height: auto;
                border-radius: 50%;
            }

            .group-name h5 {
                font-size: 16px;
                font-weight: bold;
                color: #333;
                margin: 0;
            }

            nav .container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: relative;
            }

            .search-bar {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                width: 40%;
                min-width: 300px;
                background: white;
                border-radius: 25px;
                padding: 8px 15px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .groupe-list {
                display: none;
                position: absolute;
                top: calc(100% + 10px);
                left: 50%;
                transform: translateX(-50%);
                width: 40%;
                min-width: 300px;
                max-height: 400px;
                overflow-y: auto;
                background: white;
                z-index: 1000;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .groupe-item {
                padding: 12px;
                cursor: pointer;
                border-bottom: 1px solid #eee;
                display: flex;
                justify-content: space-between;
                align-items: center;
                transition: all 0.2s;
            }

            .btn-rejoindre {
                background: #0998c1;
                color: white;
                border: none;
                padding: 6px 12px;
                border-radius: 4px;
                cursor: pointer;
            }
       /* Styles pour les messages */
.messages {
    position: fixed;
   
    top: 80px; /* Ajustez selon la hauteur de votre header */
    width: 300px; /* Largeur fixe ou pourcentage */
    height: calc(110vh - 160px); /* 160px = top + bottom margins */
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    padding: 15px;
}

.scrollable-messages {
    flex: 1;
    overflow-y: auto;
    padding-right: 10px;
    margin-bottom: 15px;
}

.message-form {
    position: sticky;
    bottom: 0;
    background: white;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

/* Pour le défilement fluide */
html {
    scroll-behavior: smooth;
}

/* Style personnalisé de la scrollbar */
.scrollable-messages::-webkit-scrollbar {
    width: 6px;
}

.scrollable-messages::-webkit-scrollbar-track {
    background:rgb(234, 159, 84);
    border-radius: 3px;
}

.scrollable-messages::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.scrollable-messages::-webkit-scrollbar-thumb:hover {
    background: #555;
}



















    display: flex;
    flex-direction: column;
    padding: 15px;
}

.message {
    margin: 15px 0;
    padding: 12px;
    border-radius: 8px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.message:hover {
    background: #e9ecef;
}

.message-body h6 {
    margin: 0 0 5px 0;
    color: #0998c1;
    font-size: 14px;
}

.message-body p {
    margin: 0;
    font-size: 14px;
    color: #333;
}

.message-body small {
    color: #6c757d;
    font-size: 12px;
}

.message-form {
    position: sticky;
    bottom: 0;
    background: white;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.input-group {
    display: flex;
    gap: 10px;
}

.input-group .input {
    flex-grow: 1;
    padding: 12px;
    border-radius: 25px;
}

.input-group button {
    border-radius: 25px;
    padding: 12px 25px;
}
.scrollable-messages {
    flex: 1;
    overflow-y: auto;
    padding-right: 10px;
    margin-bottom: 15px;
}
html {
    scroll-behavior: smooth;
}

/* Style personnalisé de la scrollbar */
.scrollable-messages::-webkit-scrollbar {
    width: 6px;
}

.scrollable-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.scrollable-messages::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.scrollable-messages::-webkit-scrollbar-thumb:hover {
    background: #555;
}
/* Ajoutez ces styles dans votre balise <style> */
.sidebar {
    height: calc(95vh - 150px); /* Ajustez la valeur selon votre header */
    display: flex;
    flex-direction: column;
    margin-top: 20px; /* Espace au-dessus du titre "MY GROUPS" */
}

.group-list {
    flex: 1;
    overflow-y: auto;
    padding-right: 8px;
    margin-top: 15px; /* Espace sous le titre */
}

/* Style personnalisé de la scrollbar */
.group-list::-webkit-scrollbar {
    width: 6px;
}

.group-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.group-list::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.group-list::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Ajustez la hauteur des éléments de groupe */
.group-list .profile {
    min-height: 70px; /* Hauteur minimale des items */
    margin: 8px 0;
}




/* Scrollbar globale */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #0998c1; /* Votre couleur bleue */
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #087ea4; /* Une nuance plus foncée au survol */
}

/* Scrollbar spécifique pour les messages */
.scrollable-messages::-webkit-scrollbar {
    width: 6px;
}

.scrollable-messages::-webkit-scrollbar-thumb {
    background: #0998c1;
}

/* Scrollbar spécifique pour la liste des groupes */
.group-list::-webkit-scrollbar {
    width: 6px;
}

.group-list::-webkit-scrollbar-thumb {
    background: #0998c1;
}

/* Scrollbar pour Firefox */
* {
    scrollbar-width: thin;
    scrollbar-color: #0998c1 #f1f1f1;
}
            
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <!-- Modals -->
        <div id="createGroupModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="closeModal('createGroupModal')">&times;</span>
            <h2>Créer un nouveau groupe</h2>
        </div>
        <div class="modal-body">
            <form id="createGroupForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nom du groupe</label>
                    <input type="text" name="nom_groupe" required class="input">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" class="input"></textarea>
                </div>
                <div class="form-group">
                    <label>Image du groupe</label>
                    <input type="file" name="group_image" accept="image/*" class="input">
                </div>
                <button type="button" class="btn btn-primary" onclick="submitGroupForm()">Créer</button>
            </form>
        </div>
    </div>
</div>



        <nav>
            <div class="container">
                <div class="logo">
                    <img src="assets/images/logo.jpg" style="width: 12%; height: 10%;">
                    <h2 class="log">Social</h2>
                </div>

                <div class="search-bar">
                    <i class="uil uil-search"></i>
                    <input type="search" id="searchGroup" 
                           placeholder="Search for groups..."
                           style="border: none; outline: none; width: 90%; padding: 0 8px;">
                </div>
                <div id="groupList" class="groupe-list"></div>

                <div class="create">
                    <label class="btn btn-primary" onclick="openModal('createGroupModal')">Create</label>
                    <div class="profile-photo">
                        <img src="assets/infos/R.jpeg">
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
                <!--Left Section-->
                <div class="left">
                    <!--Profile Section-->
                    <?php if (isset($groupee)): ?>
        <a class="profile" href="routeur.php?action=profilGroupe&id_groupe=<?php echo $groupee['id_groupe']; ?>" onclick="setGroupeSession(<?php echo $groupe['id_groupe']; ?>)" >

        
        <div class="profile-photo">
        <?php if (!empty($groupee['photogroupe'])): ?>
          <img src="data:image/jpeg;base64,<?= base64_encode($groupee['photogroupe']) ?>" alt="Cover photo">
        <?php endif; ?>
        </div>

        <div class="card-body">
            <!-- Afficher le nom du groupe -->
            <h5 class="card-title"><?php echo htmlspecialchars($groupee['nom_groupe']); ?></h5>
 
        </div>
    </a>
<?php else: ?>
    <p>Informations du groupe non disponibles.</p>
<?php endif; ?>
                    <!--End Of Profile Section-->
                    <!--Side Bar Section-->
                    <div class="sidebar">
                        <a class="menu-item active">
                            <span><i class="uil uil-add"></i></span>
                            <h3>MY GROUPS</h3>
                        </a>
                      
                        <div class="group-liste">
                             <?php if (!empty($groupes) && is_array($groupes)) : ?>
                             <?php foreach ($groupes as $groupe) : ?>
                                <a class="profile" href="routeur.php?action=mesGroupes&id_groupe=<?php echo $groupe['id_groupe']; ?>" onclick="setGroupeSession(<?php echo $groupe['id_groupe']; ?>)" >

                                <div class="profile-photo">
                                    <?php if (!empty($groupe['photogroupe'])): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($groupe['photogroupe']) ?>" alt="../assets/infos/R.jpeg">
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($groupe['nom_groupe']) ?></h5>
                                </div>
                                </a>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <p>Aucun groupe trouvé.</p>
                            <?php endif; ?>
                            <!--<a class="profile" >
                            <ul>
                                 <?php foreach ($groupes as $groupe) : ?>
                                 <li>
                                    <a href="#" onclick="setGroupeSession(<?php echo $groupe['id_groupe']; ?>)">
                                        <?php echo htmlspecialchars($groupe['nom_groupe']); ?>
                                    </a>
                                 </li>
                                <?php endforeach; ?>
                            </ul>
                            </a>-->
                            <script>
                                function setGroupeSession(idGroupe) {
                                fetch('../controllers/set_groupe_session.php?id_groupe=' + idGroupe)
                                .then(response => console.log("ID du groupe stocké en session"))
                                .catch(error => console.error("Erreur :", error));
                                }
                            </script>
                        </div>
                        <!--End Of Sidebar Section-->
                    </div>
                    </div>
                <!--End Of Left Section-->
                <!--Middle Section-->
                <div class="middle">
                    <!--End Of The Shorts Stories Section-->
                    <!-- The Create Post Section-->
                    <form class="create-post">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg ">                       </div>
                        <input type="text" placeholder="What's on your mine?" id="create-post">
                        <!-- Trigger/Open The Modal -->
                        <input value="Post" class="btn btn-primary" id="myBtn">
                    </form>
                    <!--End Of The Create Post Section-->
                    <!--The Feeds Section-->
                    <div class="feeds">
                        <?php
                        foreach($tabRes as $uneLigne) {
                            ?>
                            <!--Feed One-->
                            <div class="feed">
                                <div class="head">
                                    <div class="user">
                                        <div class="profile-photo">
                                            <img src="assets/infos/R.jpeg">
                                        </div>
                                        <div class="ingo">
                                            <?php echo "  <h3>".$uneLigne["Titre"]."</h3>";?>
                                            <small><?php echo $uneLigne["contenu"] ?>, <span class="capitalise"><?php echo $uneLigne["created_at"] ?></span></small>
                                        </div>
                                    </div>
                                    <span class="edit">
                                        <i class="uil uil-ellipsis-h"></i>
                                    </span>
                                </div>
                                <div class="photo">
                                    <?php if ($uneLigne['photo']) {
                                        # code...
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($uneLigne['photo']) . '" alt="Photo de l\'objet">';
                                    }  ?>
                                </div>
                                
                            </div>
                            <?php
                        }
                    ?>  
                    </div>
                    <!--End of The Feeds Section-->
                </div>
                <!--End of Middle Section-->
                <!--Right Section-->
                <div class="right">
                    <!--Start of Messages-->
                    <!-- Remplacer la section des messages statiques par -->

  <!-- Modifier la section des messages comme ceci -->
<!-- Dans la section messages -->
<div class="messages">
    <div class="heading">
        <h4>Messages</h4>
    </div>
    
    <div class="scrollable-messages" id="messages-container">
        <?php foreach ($messages as $message): ?>
        <div class="message">
            <div class="message-body">
                <h6>
                    <?= htmlspecialchars($message['expediteur_prenom'] . ' ' . $message['expediteur_nom']) ?>
                </h6>
                <p><?= htmlspecialchars($message['contenu']) ?></p>
                <small>
                    <?= date('H:i', strtotime($message['date_heure'])) ?>
                </small>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Formulaire d'envoi de message -->
    <div class="message-form">
        <form id="sendMessageForm">
            <div class="input-group">
                <input type="text" name="message" id="messageInput" 
                       placeholder="Écrire un message..." class="input" required>
                <button type="submit" class="btn btn-primary">
                    <i class="uil uil-message"></i> Envoyer
                </button>
            </div>
        </form>
    </div>
</div>

                    <!--End of Message-->
                    <!--Friend Request-->
                    
                <!--End of Right Section-->
            </div>
        </main>

        <div class="customize-theme">
            <div class="card">
                <h2>Customize your view</h2>
                <p class="text-muted">Manage your font size, color and background.</p>

                <!--Font Sizes Section-->
                <div class="font-size">
                    <h4>Font Size</h4>
                    <div>
                        <h6>Aa</h6>
                    <div class="choose-size">
                        <span class="font-size-1"></span>
                        <span class="font-size-2"></span>
                        <span class="font-size-3 active"></span>
                        <span class="font-size-4"></span>
                        <span class="font-size-5"></span>
                    </div>
                    <h3>Aa</h3>
                    </div>
                </div>
                <!--End of Font Size Section-->
                <!--Primary Colours Section-->
                <div class="colour">
                    <h4>Colour</h4>
                    <div class="choose-colour">
                        <span class="colour-1 active"></span>
                        <span class="colour-2"></span>
                        <span class="colour-3"></span>
                        <span class="colour-4"></span>
                        <span class="colour-5"></span>
                    </div>
                </div>
                <!--End of Primary Colours Section-->
                <!--Background Colours-->
                <div class="background">
                    <h4>Background</h4>
                    <div class="choose-bg">
                        <div class="bg-1 active">
                            <span></span>
                            <h5 for="bg-1">Light</h5>
                        </div>
                        <div class="bg-2">
                            <span></span>
                            <h5 for="bg-2">Dim</h5>
                        </div>
                        <div class="bg-3">
                            <span></span>
                            <h5 for="bg-3">Lights Out</h5>
                        </div>
                    </div>
                </div>
                <!--End of Background Colours Section-->
            </div>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <div style="    display: flex">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="handle" style="margin-left: 3vh;">
                            <h4 style="color:black">Ren Lum-Fao</h4>
                            <p class="text-muted">
                                @renlumfao
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div styles="max-width: 600px;
                                margin: auto;
                                background: #fff;
                                padding: 20px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                border-radius: 8px;">
                                
                                <h2>Formulaire de Publication</h2>
<form action="controleurs/Postegr.php" method="post" enctype="multipart/form-data">
    <!-- Champs cachés pour l'ID du groupe et l'ID utilisateur -->
    <input type="hidden" name="id_groupe" id="id_groupe" value="<?php echo isset($_SESSION['id_groupe']) ? $_SESSION['id_groupe'] : ''; ?>">
    <input type="hidden" name="id" id="id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>">

    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required class="input">

    <label for="contenu">Contenu :</label>
    <textarea id="contenu" name="contenu" rows="8" required class="input"></textarea>

    <div class="file-input-container">
        <label for="image">Sélectionner une image :</label>
        <input type="file" id="image" name="image" accept="image/*" required onchange="updateFileName()">
        <span id="file-name">Aucune image sélectionnée</span>
    </div>

    <button class="button" type="submit">Publier</button>
</form>
                    </div>
                </div>
                
            </div>
        
        </div>


        <script>
let currentGroupId = null;

async function submitGroupForm() {
    const formData = new FormData(document.getElementById('createGroupForm'));
    
    try {
        const response = await fetch('routeur.php?action=creerGroupe', {
            method: 'POST',
            body: formData
        });

        // Gérer la redirection côté serveur
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }

        const data = await response.json();
        if (!data.success) {
            throw new Error(data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert(error.message || "Erreur lors de la création du groupe");
    }
}


// Gestion des modals
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        closeModal(event.target.id);
    }
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeModal('createGroupModal');
        closeModal('addMembersModal');
    }
});
</script>
        
        <script> 

    
        $(document).ready(function() {
    // Afficher la liste au focus
    $("#searchGroup").on("focus", function() {
        showGroupList();
    });

    // Gestion de la saisie
    $("#searchGroup").on("input", function() {
        var searchText = $(this).val();
        
        if(searchText.length > 0) {
            $.ajax({
                url: 'routeur.php?action=searchGroups',
                type: 'GET',
                data: { search: searchText },
                success: function(data) {
                    $("#groupList").html(data).show();
                }
            });
        } else {
            showGroupList();
        }
    });

    // Cacher la liste quand on clique dehors
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#searchGroup, #groupList').length) {
            $("#groupList").hide();
        }
    });
});

function showGroupList() {
    $.ajax({
        url: 'routeur.php?action=searchGroups',
        type: 'GET',
        success: function(data) {
            $("#groupList")
                .html(data)
                .show()
                .css({
                    'top': $('#searchGroup').offset().top + $('#searchGroup').outerHeight() + 10,
                    'left': '50%',
                    'transform': 'translateX(-50%)'
                });
        }
    });
}
</script>  

<script>
function updateFileName() {
    var input = document.getElementById('image');
    var fileNameDisplay = document.getElementById('file-name');
    fileNameDisplay.textContent = input.files.length > 0 ? input.files[0].name : "Aucune image sélectionnée";
}
</script>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            //var span = document.getElementsByClassName("close")[0];
            var span = modal.querySelector('.close');

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
            modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            }
        </script>
        <script>
// Envoi de message
$('#sendMessageForm').submit(function(e) {
    e.preventDefault();
    const message = $('#messageInput').val().trim();
    const idGroupe = <?= $_SESSION['id_groupe'] ?? 0 ?>;

    if(message && idGroupe) {
        $.post('routeur.php?action=envoyerMessage', {
            contenu: message,
            id_groupe: idGroupe
        }, function() {
            $('#messageInput').val('');
            refreshMessages();
        });
    }
});

// Rafraîchissement automatique
function refreshMessages() {
    $('#messages-container').load(' #messages-container > *', function() {
        this.scrollTop = this.scrollHeight;
    });
}

setInterval(refreshMessages, 3000);

// Scroll automatique vers le bas
$('.scrollable-messages').scrollTop($('.scrollable-messages')[0].scrollHeight);
</script>
        <script src="js/script.js"></script>
    </body>
</html>
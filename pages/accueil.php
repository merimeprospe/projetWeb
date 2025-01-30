

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TMF's Social Media</title>
        <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
        <meta name="description" content="TMF's Social Media">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- My Custom Stylesheet -->
        <link rel="stylesheet" href="css/accueil_.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    </head>
    <style>
        
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <body>

        <!--------Navigation Section---------->

        <nav>
            <div class="container">
                <div class="logo">
                    <img src="assets/images/logo.jpg" style="width: 12%; height: 10%;">
                    <h2 class="log">
                        Social
                    </h2>
                </div>
                <div class="search-bar">
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search for inspiration and projects..." id="search">
                </div>
                <div class="create">
                    <label class="btn btn-primary" onclick="rediriger()" for="create post">Create</label>
                    <div class="profile-photo">

                        <a href="controleurs/profile.php">
                            <!------<img src="assets/profile_img-88x88/profile1-88x88.jpg">------->
                            <img src="assets/infos/R.jpeg">
                        </a>
                        
                    </div>
                </div>
            </div>
        </nav>
        <!--------End of Navigation Section---------->
        <!-----------Main----------->

        <main>
            <div class="container">
                <!--Left Section-->
                <div class="left">
                    <!--Profile Section-->
                    <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="handle">
                            <h4>Ren Lum-Fao</h4>
                            <p class="text-muted">
                                @renlumfao
                            </p>
                        </div>
                    </a>
                    <!--End Of Profile Section-->
                    <!--Side Bar Section-->
                    <div class="sidebar">
                        <a class="menu-item active">
                            <span><i class="uil uil-home"></i></span>
                            <h3>Home</h3>
                        </a>
                        <a class="menu-item" id="notifications">
                            <span><i class="uil uil-bell"><small class="notification-count"><?php echo count($notif)  ?></small></i></span>
                            <h3>Notification</h3>
                            <!--Notification Pop Up Section-->
                            <div class="notifications-popup scrollable-div">
                                <?php
                                foreach($notif as $uneLigne) {
                                    ?>
                                    <div style= "display: flex;gap: 10px; margin:10px">
                                        <div class="profile-photo">
                                            <img src="assets/infos/R.jpeg" />
                                        </div>
                                        <div class="notificaion-body" style="margin-top: 10px;">
                                            <b> <?php echo $uneLigne->getSendUser() ?></b> <?php echo $uneLigne->getMessage() ?>
                                            <small class="text-muted">Now</small>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                            <!--End of Notification Popup Section-->
                        </a>
                        <a class="menu-item" id="messages-notification">
                            <span><i class="uil uil-envelope"><small class="notification-count">6+</small></i></span>
                            <h3>Message</h3>
                        </a>
                        <a class="menu-item" id="theme">
                            <span><i class="uil uil-palette"></i></span>
                            <h3>Theme</h3>
                        </a>
                        <a class="menu-item">
                            <span><i class="uil uil-setting"></i></span>
                            <h3>Settings</h3>
                        </a>    
                    </div>
                    <!--End Of Sidebar Section-->
                    <label for="create-post" class="btn btn-primary">Create Post</label>
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
                        <!--Feed One-->
                        <div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                        <img src="assets/infos/R.jpeg">
                                    </div>
                                    <div class="ingo">
                                        <h3>Frosty</h3>
                                        <small>Birmingham, United Kingdom, <span class="capitalise">44 minutes ago</span></small>
                                    </div>
                                </div>
                                <span class="edit">
                                    <i class="uil uil-ellipsis-h"></i>
                                </span>
                            </div>
                            <div class="photo">
                                <img src="assets/infos/R.jpeg">                       </div>
                            <div class="action-buttons">
                                <div class="interaction-buttons">
                                    <span><i class="uil uil-heart"></i></span>
                                    <span><i class="uil uil-comment-dots"></i></span>
                                    <span><i class="uil uil-share-alt"></i></span>
                                </div>
                                <div class="bookmark">
                                    <span><i class="uil uil-bookmark-full"></i></span>
                                </div>
                            </div>
                            <div class="liked-by">
                                <span><img src="./assets/profile_img-44x44/profile3-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile6-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile2-44x44.jpg" ></span>
                                <p>Liked by <b>Spider-Man</b> and <b>7,231 others</b></p>
                            </div>

                            <div class="caption">
                                <p><b>Frosty</b> Check out this game running on the Steam Deck! <span class="hash-tag">#Amazing</span></p>
                            </div>
                            <div class="comments text-muted">View All 532 comments</div>
                        </div>
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
                                            <small><?php echo $uneLigne["Titre"] ?>, <span class="capitalise"><?php echo $uneLigne["created_at"] ?></span></small>
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
                                <div class="action-buttons">
                                    <div class="interaction-buttons">
                                        <span><i class="uil uil-heart"></i></span>
                                        <span><i class="uil uil-comment-dots"></i></span>
                                        <span><i class="uil uil-share-alt"></i></span>
                                    </div>
                                    <div class="bookmark">
                                        <span><i class="uil uil-bookmark-full"></i></span>
                                    </div>
                                </div>
                                <div class="liked-by">
                                    <span><img src="assets/infos/R.jpeg"></span>
                                    <span><img src="assets/infos/R.jpeg"></span>
                                    <span><img src="assets/infos/R.jpeg"></span>
                                    <p>Liked by <b>Spider-Man</b> and <b>7,231 others</b></p>
                                </div>

                                <div class="caption">
                                    <p><b>Frosty</b> <?php echo $uneLigne["contenu"] ?> <span class="hash-tag">#Amazing</span></p>
                                </div>
                                <div class="comments text-muted">View All 532 comments</div>
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
                    <div class="messages">
                        <div class="heading">
                            <h4>Messages</h4><i class="uil uil-edit"></i>
                        </div>
                        <!--Search Bar-->
                        <div class="search-bar">
                            <i class="uil uil-search"></i>
                            <input type="search" placeholder="Search message..." id="message-search">
                        </div>
                        <!--End of Search Bar-->
                        <!--Messages Category-->
                        <div class="category">
                            <h6 class="active">Primary</h6>
                            <h6>General</h6>
                            <h6 class="message-requests">Requests(7)</h6>
                        </div>
                        <!--End of Messages Category-->
                        <!--Message One-->
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/Profile4-88x-88.jpg" >
                            </div>
                            <div class="message-body">
                                <h5>Ferhan Ahmed</h5>
                                <p class="text-muted">I love my cars too much 😍</p>
                            </div>
                        </div>
                        <!--Message Two-->
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile2-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h5>Tayyab Javed</h5>
                                <p class="text-bold">Hey Check Out My Bird 🦜</p>
                            </div>
                        </div>
                        <!--Message Three-->
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile7-88x88.jpg" >
                            </div>
                            <div class="message-body">
                                <h5>Warm Soda</h5>
                                <p class="text-muted">Look at my doggy 🐶</p>
                            </div>
                        </div>
                        <!--Message Four-->
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h5>Sheikhba Mohammed</h5>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                    </div>
                    <!--End of Message-->
                    <!--Friend Request-->
                    <div class="friend-requests">
                        <h4>Requests</h4>
                     <?php
                        foreach($invits as $uneLigne) {
                            if ($uneLigne->decision==false) {
                                
                            ?>

                            <div class="request" id="<?php echo 'btn' . $uneLigne->id ?>">
                                <div class="info">
                                    <div class="profile-photo">
                                        <img src="assets/infos/R.jpeg">
                                    </div>
                                    <div>
                                        <h5><?php echo $uneLigne->amie ?></h5>
                                        <p class="text-muted" style="font-size: 13px;">
                                         <?php echo $uneLigne->date ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="action">
                                    <button class="btn btn-primary" onclick="accepter(<?php echo $uneLigne->id?>)">
                                        Accept
                                    </button>
                                    <button class="btn btn-secondary" onclick="refuser(<?php echo $uneLigne->id?>)">
                                        Decline
                                    </button>
                                </div>
                            </div>
                        <?php }}?>
                        
                    </div>
                </div>
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
                        <form action="controleurs/poste.php" method="post" enctype="multipart/form-data">
                            <label for="titre">Titre :</label>
                            <input type="text" id="titre" name="titre" required class="input">

                            <label for="contenu">Contenu :</label>
                            <textarea id="contenu" name="contenu" rows="8" required class="input"></textarea>

                            <div class="file-input-container">
                                <label for="image">Sélectionner une image</label>
                                <input type="file" id="image" name="image" accept="image/*" required>
                                <span id="file-name">Aucune image sélectionnée</span>
                            </div>

                            <button class="button" type="submit">Publier</button>
                        </form>
                    </div>
                </div>
                
            </div>
        
        </div>
        
        <script>
            function refuser(id) {
                console.log("btn: "+id);
                $.get("controleurs/deletAmie.php?id="+id+"&action=deletid", traiterReponseDemande01(id));
            }

            function accepter(id) {
                console.log("btn: accepter"+id);
                $.get("controleurs/deletAmie.php?id="+id+"&action=Accepter", traiterReponseDemande01(id));
            }

            function traiterReponseDemande01(id) {
                console.log("btn"+id);
                document.getElementById("btn"+id).className  = "hidden"
            }

            const fileInput = document.getElementById('image');
            const fileName = document.getElementById('file-name');

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileName.textContent = fileInput.files[0].name;
                } else {
                    fileName.textContent = 'Aucune image sélectionnée';
                }
            });
        </script>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

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
            function rediriger() {
                if (document.getElementById("search").value) {
                    
                   window.location.href = "controleurs/amie.php?val="+document.getElementById("search").value;
                }
                
            }
        </script>
        <script src="js/script.js"></script>
    </body>
</html>
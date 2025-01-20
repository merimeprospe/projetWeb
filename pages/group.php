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
        <link rel="stylesheet" href="../css/accueil_.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    </head>
    <style>
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        .input{
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .file-input-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .file-input-container input[type="file"] {
            display: none;
        }
        .file-input-container label {
            background: #0998c1;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .file-input-container span {
            font-size: 14px;
            color: #555;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #0998c1;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background:rgb(210, 232, 243);
            color: #0998c1;
            
        }
        body {font-family: Arial, Helvetica, sans-serif;}

        /* The Modal (background) */
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        /* Other styles */ 
        .menu-items { display: inline-block; margin-right: 20px; /* Add space between icons */ } 
        .menu-items i { width: 30px; /* Increase width */ height: 30px; /* Increase height */ font-size: 30px; /* Increase font size for bigger icons */ }

        /* Modal Content */
        .modal-content {
        z-index: 10px;
        border-radius: 10px;
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        padding: 4vh;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
        
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
        }

        @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
        }

        /* The Close Button */
        .close {
        color: #0998c1;
        float: right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }

        .modal-header {
        padding: 2px 16px;
        background-color:rgb(255, 255, 255);
        color: white;
        }

        .modal-body {padding: 2px 16px;}

        .modal-footer {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
        }
    </style>
    <body>

        <!--------Navigation Section---------->

        <nav> 
            <div class="container"> 
                <div class="logo">
                     <img src="assets/images/logo.jpg" style="width: 12%; height: 10%;"> 
                     <h2 class="log"> Social </h2> 
                </div> 
                <div class="search-bar"> 
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search for groups."> 
                </div> 
                <div class="create">
                     <label class="btn btn-primary" for="create post">Create</label> 
                </div>
                 <div class="menu-items"> 
                    <i class="uil uil-home"></i> 
                </div> 
               
                </div> 
                </nav>

        <main>
            <div class="container">
                <!--Left Section-->
                <div class="left">
                    <!--Profile Section-->
                    <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            
                        </div>
                    </a>
                    <!--End Of Profile Section-->
                    <!--Side Bar Section-->
                    <div class="sidebar">
                        <a class="menu-item active">
                            <span><i class="uil uil-add"></i></span>
                            <h3>MY GROUPS</h3>
                        </a>
                        <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            
                        </div>
                        </a>
                        <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            
                        </div>
                        </a>
                        <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            
                        </div>
                        </a>
                        <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            
                        </div>
                        </a>
                        <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            
                        </div>
                        </a>
                        <a class="profile">
                        <div class="profile-photo">
                            <img src="assets/infos/R.jpeg" />
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Group Name</h5>
                            
                        </div>
                        </a>
                        
                    </div>
                    <!--End Of Sidebar Section-->
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
                        
                        <!--End of Messages Category-->
                        <!--Message One-->
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/Profile4-88x-88.jpg" >
                            </div>
                            <div class="message-body">
                                <h6>Ferhan Ahmed</h6>
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
                                <h6>Tayyab Javed</h6>
                                <p class="text-bold">Hey Check Out My Bird 🦜</p>
                            </div>
                        </div>
                        <!--Message Three-->
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile7-88x88.jpg" >
                            </div>
                            <div class="message-body">
                                <h6>Warm Soda</h6>
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
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
                        </div>
                        <div class="message">
                            <div class="profile-photo">
                                <img src="./assets/profile_img-88x88/profile6-88x88.jpg" >
                                <div class="active"></div>
                            </div>
                            <div class="message-body">
                                <h6>Sheikhba Mohammed</h6>
                                <p class="text-bold">🐍 Hey, stop ignoring me!</p>
                            </div>
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
        </script>
        <script src="js/script.js"></script>
    </body>
</html>
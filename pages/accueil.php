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
        <link rel="stylesheet" href="../css/accueil.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    </head>
    <body>

        <!--------Navigation Section---------->

        <nav>
            <div class="container">
                <div class="logo">
                    <img src="assets/TMF FACE smaller.png" style="width: 10%; height: 10%;">
                    <h2 class="log">
                        TMF's Social
                    </h2>
                </div>
                <div class="search-bar">
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search for inspiration and projects...">
                </div>
                <div class="create">
                    <label class="btn btn-primary" for="create post">Create</label>
                    <div class="profile-photo">
                        <a href="profile.php">
                            <img src="assets/profile_img-88x88/profile1-88x88.jpg">
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
                            <img src="./assets/profile_img-88x88/profile1-88x88.jpg" />
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
                        <a class="menu-item">
                            <span><i class="uil uil-compass"></i></span>
                            <h3>Explore</h3>
                        </a>
                        <a class="menu-item" id="notifications">
                            <span><i class="uil uil-bell"><small class="notification-count">9+</small></i></span>
                            <h3>Notification</h3>
                            <!--Notification Pop Up Section-->
                            <div class="notifications-popup">
                                <div>
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-44x44/profile2-44x44.jpg" />
                                    </div>
                                    <div class="notificaion-body">
                                        <b>Tayyab Javed</b> accepted your friend request
                                        <small class="text-muted">Now</small>
                                    </div>
                                </div>
                                <div>
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-44x44/profile3-44x44.jpg" />
                                    </div>
                                    <div class="notificaion-body">
                                        <b>Spider-Man</b> accepted your friend request
                                        <small class="text-muted">7 Minutes Ago</small>
                                    </div>
                                </div>
                                <div>
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-44x44/profile4-44x44.jpg" />
                                    </div>
                                    <div class="notificaion-body">
                                        <b>Ferhan Ahmed</b> commendted on your post
                                        <small class="text-muted">1 Hour Ago</small>
                                    </div>
                                </div>
                                <div>
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-44x44/profile5-44x44.jpg" />
                                    </div>
                                    <div class="notificaion-body">
                                        <b>Frosty</b> and <b>372 others</b> liked your post
                                        <small class="text-muted">1 Day Ago</small>
                                    </div>
                                </div>
                                <div>
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-44x44/profile6-44x44.jpg" />
                                    </div>
                                    <div class="notificaion-body">
                                        <b>Sheikhba Mohammed</b> commented on a post that you was tagged in
                                        <small class="text-muted">2 Day Ago</small>
                                    </div>
                                </div>
                                <div>
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-44x44/profile7-44x44.jpg" />
                                    </div>
                                    <div class="notificaion-body">
                                        <b>Warm Soda</b> has sent you a friend request
                                        <small class="text-muted">4 Days Ago</small>
                                    </div>
                                </div>
                            </div>
                            <!--End of Notification Popup Section-->
                        </a>
                        <a class="menu-item" id="messages-notification">
                            <span><i class="uil uil-envelope"><small class="notification-count">6+</small></i></span>
                            <h3>Message</h3>
                        </a>
                        <a class="menu-item">
                            <span><i class="uil uil-bookmark"></i></span>
                            <h3>Bookmarks</h3>
                        </a>
                        <a class="menu-item">
                            <span><i class="uil uil-chart-line"></i></span>
                            <h3>Analytics</h3>
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
                            <img src="assets/profile_img-44x44/profile1-44x44.jpg">
                        </div>
                        <input type="text" placeholder="What's on your mine?" id="create-post">
                        <input type="submit" value="Post" class="btn btn-primary">
                    </form>
                    <!--End Of The Create Post Section-->
                    <!--The Feeds Section-->
                    <div class="feeds">
                         <!--Feed One-->
                        <div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-88x88/profile5-88x88.jpg">
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
                                <img src="./assets/feed/IMG_20220901_024323.webp">
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
                        <!--Feed Two-->
                        <div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-88x88/profile2-88x88.jpg">
                                    </div>
                                    <div class="ingo">
                                        <h3>Tayyab Javed</h3>
                                        <small>Birmingham, United Kingdom, <span class="capitalise">1 day ago</span></small>
                                    </div>
                                </div>
                                <span class="edit">
                                    <i class="uil uil-ellipsis-h"></i>
                                </span>
                            </div>
                            <div class="photo">
                                <img src="./assets/feed/323795939_563033139008315_7397776276369466911_n.webp">
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
                                <span><img src="./assets/profile_img-44x44/profile7-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile6-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile4-44x44.jpg" ></span>
                                <p>Liked by <b>Warm Soda</b> and <b>5,317 others</b></p>
                            </div>

                            <div class="caption">
                                <p><b>Tayyab Javed</b> Hungry Bubble 🦜 Stole my toast! 😠 <span class="hash-tag">#Parrot</span></p>
                            </div>
                            <div class="comments text-muted">View All 532 comments</div>
                        </div>
                        <!--Feed Three-->
                        <div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-88x88/Profile4-88x-88.jpg">
                                    </div>
                                    <div class="ingo">
                                        <h3>Ferhan Ahmed</h3>
                                        <small>Island in Barry, Wales, <span class="capitalise">3 days ago</span></small>
                                    </div>
                                </div>
                                <span class="edit">
                                    <i class="uil uil-ellipsis-h"></i>
                                </span>
                            </div>
                            <div class="photo">
                                <img src="./assets/feed/20160921_142833.webp">
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
                                <span><img src="./assets/profile_img-44x44/profile1-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile3-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile5-44x44.jpg" ></span>
                                <p>Liked by <b>Ren Lum-Fao</b> and <b>6,541 others</b></p>
                            </div>

                            <div class="caption">
                                <p><b>Ferhan Ahmed</b> Looks at me standing on this rock! <span class="hash-tag">#BarryIsland</span></p>
                            </div>
                            <div class="comments text-muted">View All 532 comments</div>
                        </div>
                        <!--Feed Four-->
                        <div class="feed">
                            <div class="head">
                                <div class="user">
                                    <div class="profile-photo">
                                        <img src="./assets/profile_img-88x88/profile1-88x88.jpg">
                                    </div>
                                    <div class="ingo">
                                        <h3>Ren Lum-Fao</h3>
                                        <small>Birmingham, United Kingdom, <span class="capitalise">7 days ago</span></small>
                                    </div>
                                </div>
                                <span class="edit">
                                    <i class="uil uil-ellipsis-h"></i>
                                </span>
                            </div>
                            <div class="photo">
                                <img src="./assets/feed/20210426_194606.webp">
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
                                <span><img src="./assets/profile_img-44x44/profile5-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile4-44x44.jpg" ></span>
                                <span><img src="./assets/profile_img-44x44/profile6-44x44.jpg" ></span>
                                <p>Liked by <b>Frosty</b> and <b>9,999 others</b></p>
                            </div>

                            <div class="caption">
                                <p><b>Frosty</b> Got myself some Mikado's, late night coding anyone? <span class="hash-tag">#Yummy</span> <span class="hash-tag">#Pocky</span></p>
                            </div>
                            <div class="comments text-muted">View All 532 comments</div>
                        </div>
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
                        <div class="request">
                            <div class="info">
                                <div class="profile-photo">
                                    <img src="./assets/profile_img-88x88/profile5-88x88.jpg">
                                </div>
                                <div>
                                    <h5>Frosty</h5>
                                    <p class="text-muted">
                                       8 mutual friends 
                                    </p>
                                </div>
                            </div>
                            <div class="action">
                                <button class="btn btn-primary">
                                    Accept
                                </button>
                                <button class="btn">
                                    Decline
                                </button>
                            </div>
                        </div>
                        <div class="request">
                            <div class="info">
                                <div class="profile-photo">
                                    <img src="./assets/profile_img-88x88/profile7-88x88.jpg">
                                </div>
                                <div>
                                    <h5>Warm Soda</h5>
                                    <p class="text-muted">
                                       4 mutual friends 
                                    </p>
                                </div>
                            </div>
                            <div class="action">
                                <button class="btn btn-primary">
                                    Accept
                                </button>
                                <button class="btn">
                                    Decline
                                </button>
                            </div>
                        </div>
                        <div class="request">
                            <div class="info">
                                <div class="profile-photo">
                                    <img src="./assets/profile_img-88x88/profile3-88x88.jpg">
                                </div>
                                <div>
                                    <h5>Spider-Man</h5>
                                    <p class="text-muted">
                                       1 mutual friends 
                                    </p>
                                </div>
                            </div>
                            <div class="action">
                                <button class="btn btn-primary">
                                    Accept
                                </button>
                                <button class="btn">
                                    Decline
                                </button>
                            </div>
                        </div>
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
        
        <script src="scripts/script.js"></script>
    </body>
</html>
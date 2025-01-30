

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f0f2f5;
    }

    .header {
      width: 100%;
      height: 400px;
      margin-top: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    /*.header .add-cover {
      position: absolute;
      bottom: 10px;
      right: 20px;
      background-color: white;
      border: 1px solid #ddd;
      padding: 10px 15px;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      
    }*/
    
    .profile-header {
      background: url('https://via.placeholder.com/1200x400') no-repeat center center;
      background-size: cover;
      height: 400px;
      position: relative;
      margin-top: -60px;
    }
    .profile-picture {
      width: 170px;
      height: 170px;
      border-radius: 40%;
      border: 5px solid #fff;
      position: absolute;
      left: 45%;
      
    }
    .profile-picture-couverture{
        width: 100%;
      height: 100%;
      border: 5px solid #fff;

    }

    .rounded-circle {
    width: 70px;
      height: 70px;
      border-radius: 50%;
      border: 5px solid #fff;

    }
    .profile-info {
    margin-top: -140px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    .nav-tabs {
      margin-top: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    .post {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    .post textarea {
      border: none;
      resize: none;
    }
    .post textarea:focus {
      outline: none;
    }
    .btn-primary {
      background-color: #1877f2;
      border: none;
    }
    .btn-primary:hover {
      background-color: #166fe5;
    }
    .btn-secondary {
      background-color: #e4e6eb;
      border: none;
      color: #000;
    }
    .btn-secondary:hover {
      background-color: #d8dadf;
    }
    .photo-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 10px;
      margin-top: 20px;
    }
    .photo-grid img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      cursor: pointer;
    }
    .friend-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .friend-card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      padding: 15px;
      text-align: center;
    }
    .friend-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .video-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .video-card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      padding: 15px;
      text-align: center;
    }
    .video-card img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 10px;
    }



    /* Styles pour la popup */
.popup {
    display: none; /* Caché par défaut */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Assure que la popup est au-dessus de tout */
    
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 700px; /* Augmenter la largeur */
    max-height: 90vh; /* Limiter la hauteur à 90% de la hauteur de l'écran */
    overflow-y: auto; /* Ajouter un défilement si le contenu dépasse */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}

.close:hover {
    color: red;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
}

input, select, textarea {
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    margin-top: 20px;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #218838;
}
  </style>

</head>
<body>

  <!-- Profile Header -->

  <div class="container header">
  <?php if ($utilisateur['photo_couverture']) {
        # code...
        echo '<img src="data:image/jpeg;base64,' . base64_encode($utilisateur['photo_couverture']) . '" alt="Photo de l\'objet" class="profile-picture-couverture"> ';
    }  ?>
  </div>

  <div class="profile-header">
  <?php if ($utilisateur['photo_profil']) {
        # code...
        echo '<img src="data:image/jpeg;base64,' . base64_encode($utilisateur['photo_profil']) . '" alt="Photo de l\'objet" class="profile-picture"> ';
    }  ?>
  </div>



  <!-- Profile Info -->
  <div class="container profile-info">
    <div class="row">
      <div class="col-md-12">
      <h1><?php echo $utilisateur["nom"] . ' ' . $utilisateur["prenom"]; ?></h1>
        <p class="text-muted"><?php echo $utilisateur["travail"]; ?></p>
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button id="editProfileButton" class="btn btn-secondary">Edit Profile</button>
          </div>
          <div>
            <span class="badge bg-success">Se déconnecter</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation Tabs -->
  <div class="container">
    <ul class="nav nav-tabs" id="profileTabs">
      <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#posts">Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#friends">Friends</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#photos">Photos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#videos">Videos</a>
      </li>
    </ul>
  </div>

  <!-- Tab Content -->
  <div class="container mt-4">
    <div class="tab-content">
      <!-- Posts Tab -->
      <div class="tab-pane fade show active" id="posts">
        <div class="row">
          <div class="col-md-8">
            <!-- Post Box -->
            <div class="card post">
              <div class="card-body">
                <textarea class="form-control mb-3" rows="3" placeholder="What's on your mind, John?"></textarea>
                <div class="d-flex justify-content-between">
                  <div>
                    <button class="btn btn-secondary">Photo/Video</button>
                    <button class="btn btn-secondary">Tag Friends</button>
                  </div>
                  <button class="btn btn-primary">Post</button>
                </div>
              </div>
            </div>

            <!-- Posts -->
            <div class="card post">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <img src="../assets/images/th.jpg" alt="User" class="rounded-circle me-2">
                  <div>
                    <h5 class="card-title mb-0"><?php echo $utilisateur["nom"] . ' ' . $utilisateur["prenom"]; ?></h5>
                    <p class="text-muted mb-0">8th June, 2014</p>
                  </div>
                </div>
                <p class="card-text">15.5K</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- About Tab -->
      <div class="tab-pane fade" id="about">
        <div class="row">
          <div class="col-md-8">
            <div class="card post">
              <div class="card-body">
                <h5 class="card-title">A propos de moi</h5>
                <p class="card-text"><strong>Work:</strong> Data Scientist at Paris</p>
                <p class="card-text"><strong>Education:</strong> 3IL ingénieurs</p>
                <p class="card-text"><strong>Location:</strong> <?php echo $utilisateur["ville"] . ', ' . $utilisateur["pays"]; ?></p>
                <p class="card-text"><strong>Hobbies:</strong> football, voyages</p>
                <p class="card-text"><strong>Biographie:</strong><div><?php echo ' ' . $utilisateur["bio"]; ?></div></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Friends Tab -->
      <div class="tab-pane fade" id="friends">
        <div class="row">
          <div class="col-md-12">
            <div class="friend-grid">
              <!-- Friend Cards -->
              <div class="friend-card">
                <img src="../assets/images/tf.jpg" alt="Friend 1">
                <h6>Jane Doe</h6>
                <p>50 Amis en commun</p>
                <button class="btn btn-primary">Add Friend</button>
              </div>
              <div class="friend-card">
                <img src="../assets/images/tf1.jpg" alt="Friend 2">
                <h6>John Smith</h6>
                <p>500 Amis en commun</p>
                <button class="btn btn-secondary">Message</button>
              </div>
              <!-- Add more friends here -->
            </div>
          </div>
        </div>
    </div>

    <!-- Photos Tab -->
    <div class="tab-pane fade" id="photos">
        <div class="row">
          <div class="col-md-12">
            <div class="photo-grid">
              <!-- Photos -->
              <img src="../assets/images/th.jpg" alt="Photo 1">
              <img src="../assets/images/photo 1.jpg" alt="Photo 2">
              <img src="../assets/images/photo 2.jpg" alt="Photo 3">
              <img src="../assets/images/photo 3.jpg" alt="Photo 4">
              <img src="../assets/images/photo 4.jpg" alt="Photo 5">
              <img src="../assets/images/photo 6.jpg" alt="Photo 6">
            </div>
          </div>
        </div>
      </div>

      <!-- Videos Tab -->
      <div class="tab-pane fade" id="videos">
        <div class="row">
          <div class="col-md-12">
            <div class="video-grid">
              <!-- Video Cards -->
              <div class="video-card">
                <img src="../assets/images/photo 3.jpg" alt="Video 1">
                <h6>My Vacation</h6>
                <p>2.5K views</p>
              </div>
              <div class="video-card">
                <img src="https://via.placeholder.com/200x150" alt="Video 2">
                <h6>Coding Tutorial</h6>
                <p>1.2K views</p>
              </div>
              <!-- Add more videos here -->
            </div>
          </div>
        </div>
      </div>
      </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>




  <!-- Popup de modification de profil -->
<div id="profilePopup" class="popup">
    <div class="popup-content">
        <span id="closePopup" class="close">&times;</span>
        <h2>Modifier le Profil</h2>
        <form action="../controleurs/profile.php?action=modifierProfil&id=<?= $utilisateur['id_user'] ?>" method="POST" enctype="multipart/form-data">
            <!-- Champ Nom -->
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= $utilisateur['nom'] ?>" required>

            <!-- Champ Prénom -->
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $utilisateur['prenom'] ?>" required>

            <!-- Champ Email -->
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?= $utilisateur['email'] ?>" required>

            <!-- Champ Sexe -->
            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe">
                <option value="Homme" <?= $utilisateur['sexe'] == 'Homme' ? 'selected' : '' ?>>Homme</option>
                <option value="Femme" <?= $utilisateur['sexe'] == 'Femme' ? 'selected' : '' ?>>Femme</option>
                <option value="Autre" <?= $utilisateur['sexe'] == 'Autre' ? 'selected' : '' ?>>Autre</option>
            </select>

            <!-- Champ Ville -->
            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" value="<?= $utilisateur['ville'] ?>">

            <!-- Champ Pays -->
            <label for="pays">Pays :</label>
            <input type="text" id="pays" name="pays" value="<?= $utilisateur['pays'] ?>">

            <!-- Champ Travail -->
            <label for="travail">Travail :</label>
            <input type="text" id="travail" name="travail" value="<?= $utilisateur['travail'] ?>">

            <!-- Champ Bio -->
            <label for="bio">Bio :</label>
            <textarea id="bio" name="bio"><?= $utilisateur['bio'] ?></textarea>

            <!-- Champ Photo -->
            <label for="photo">Photo de profil :</label>
            <input type="file" id="photo" name="photo" accept="image/*">

            <!-- Champ Photo couverture -->
            <label for="photo">Photo de couverture :</label>
            <input type="file" id="photo_cuverture" name="photo_couverture" accept="image/*">

            <!-- Bouton de soumission -->
            <button type="submit">Enregistrer les modifications</button>
        </form>
    </div>
</div>


<script>
    // Récupérer les éléments du DOM
    const editProfileButton = document.getElementById('editProfileButton'); // Bouton "Edit Profile"
    const closePopupButton = document.getElementById('closePopup'); // Bouton pour fermer la popup
    const profilePopup = document.getElementById('profilePopup'); // La popup elle-même

    // Ouvrir la popup lorsque l'utilisateur clique sur "Edit Profile"
    editProfileButton.addEventListener('click', () => {
        profilePopup.style.display = 'flex'; // Afficher la popup
    });

    // Fermer la popup lorsque l'utilisateur clique sur le bouton "×"
    closePopupButton.addEventListener('click', () => {
        profilePopup.style.display = 'none'; // Masquer la popup
    });

    // Fermer la popup si l'utilisateur clique en dehors de la popup
    window.addEventListener('click', (event) => {
        if (event.target === profilePopup) {
            profilePopup.style.display = 'none'; // Masquer la popup
        }
    });
</script>
</body>
</html>


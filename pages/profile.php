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

    .profile-picture-couverture {
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
      display: none;
      /* Caché par défaut */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      /* Fond semi-transparent */
      justify-content: center;
      align-items: center;
      z-index: 1000;
      /* Assure que la popup est au-dessus de tout */

    }

    .popup-content {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      width: 700px;
      /* Augmenter la largeur */
      max-height: 90vh;
      /* Limiter la hauteur à 90% de la hauteur de l'écran */
      overflow-y: auto;
      /* Ajouter un défilement si le contenu dépasse */
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

    input,
    select,
    textarea {
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

    .photo-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 15px;
      padding: 15px;
    }

    .img-thumbnail {
      transition: transform 0.3s ease;
      height: 200px;
      object-fit: cover;
    }

    .img-thumbnail:hover {
      transform: scale(1.05);
      cursor: pointer;
    }

    .modal-content {
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(5px);
    }

    .btn-primary {
      background-color: #0998c1;
      border-color: #0998c1;
    }

    .btn-secondary {
      background-color: hsl(13.01deg 79.05% 58.82%);
      border-color: hsl(13.01deg 79.05% 58.82%);
      color: #fff;
      /* Si vous voulez modifier aussi la couleur au survol, etc. */
    }

    .nav-link {
      background-color: #0998c1;
      color: #0998c1;

    }
  </style>

</head>

<body>

  <div class="container">
    <div class="container mt-3">
      <!-- Bouton retour à l'accueil -->
      <a href="routeur.php?action=accueil" class="btn btn-primary">&larr; Retour à l'accueil</a>
    </div>
    <div class="container header">
      <?php if ($utilisateur['photo_couverture']) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($utilisateur['photo_couverture']) . ' alt="Photo de couverture" class="profile-picture-couverture">';
      } else {
        echo '<img src="assets/images/3il.png" alt="Photo de couverture par défaut" class="profile-picture-couverture">';
      } ?>
    </div>


    <div class="profile-header">
      <?php if ($utilisateur['photo_profil']) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($utilisateur['photo_profil']) . ' alt="Photo de profil" class="profile-picture">';
      } else {
        $defaultPhoto = 'assets/images/defaut.jpg';
        echo '<img src="' . $defaultPhoto . '" alt="Photo de profil par défaut" class="profile-picture">';
      } ?>
    </div>
    <!-- Profile Info -->
    <div class="position-relative py-3">
      <div class="container profile-info">
        <div class="row">
          <div class="col-md-12">
            <h1><?php echo $utilisateur["nom"] . ' ' . $utilisateur["prenom"]; ?></h1>
            <p class="text-muted"><?php echo $utilisateur["email"]; ?></p>
            <div class="d-flex justify-content-between align-items-center">
              <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $utilisateur['id_user']) : ?>
                <button id="editProfileButton" class="btn btn-secondary">Edit Profile</button>
              <?php endif; ?>
              <div onclick="Logout()" style="cursor: pointer;">
                <button class="btn btn-secondary" style="cursor: pointer;">Se deconnecter</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation Tabs -->

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

    <div class="row mt-3">
      <div class="col-md-4">
        <div class="card p-3">
          <h5>Informations</h5>
          <p>Travaille à tant que <strong><?php echo $utilisateur["travail"]; ?></strong></p>
          <p>Vit à <strong><?php echo $utilisateur["ville"]; ?></strong></p>
          <p>Inscrit depuis <strong><?php echo $utilisateur["creer_le"]; ?></strong></p>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card p-3 mb-3">
          <h5>Nouvelle publication</h5>
          <textarea class="form-control" rows="3" placeholder="Exprimez-vous..."></textarea>
          <button class="btn btn-primary mt-2">Publier</button>
        </div>
        <div class="container mt-4">
          <div class="tab-content">
            <!-- Posts Tab -->
            <div class="tab-pane fade show active" id="posts">
              <div class="row">
                <div class="col-md-10">
                  <!-- Posts -->
                  <?php if (!empty($publications)): ?>
                    <?php foreach ($publications as $publication): ?>
                      <div class="card post">
                        <div class="card-body">
                          <div class="d-flex align-items-center mb-3">
                            <img src="<?php
                                      $defaultPhoto = 'assets/images/defaut.jpg';
                                      echo ($utilisateur['photo_profil']) ?
                                        'data:image/jpeg;base64,' . base64_encode($utilisateur['photo_profil']) :
                                        $defaultPhoto;
                                      ?>"
                              class="rounded-circle me-2" width="50">
                            <div>
                              <h5><?php echo htmlspecialchars($utilisateur["nom"] . ' ' . $utilisateur["prenom"]); ?></h5>
                              <small><?php date_default_timezone_set('Europe/Paris');
                                          echo date('d/m/Y', strtotime($publication["created_at"])); ?></small>
                              

                            </div>
                          </div>
                          <?php if ($publication['photo']): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($publication['photo']) ?>" class="img-fluid mb-3" alt="Publication">
                          <?php endif; ?>
                          <p><?php echo htmlspecialchars($publication["contenu"]); ?></p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <p>Aucune publication à afficher.</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- About Tab -->
            <div class="tab-pane fade" id="about">
              <div class="row">
                <div class="col-md-12">
                  <div class="card post">
                    <div class="card-body">
                      <h5 class="card-title">A propos de moi</h5>
                      <p class="card-text"><strong>Work:</strong> <?php echo $utilisateur["travail"]; ?></p>
                      <p class="card-text"><strong>Location:</strong> <?php echo $utilisateur["ville"] . ', ' . $utilisateur["pays"]; ?></p>
                      <p class="card-text"><strong>Hobbies:</strong> <?php echo $utilisateur["loisirs"]; ?></p>
                      <p class="card-text"><strong>Biographie:</strong> <?php echo $utilisateur["bio"]; ?></p>
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

                    <!-- Demandes en attente -->
                    <?php if (!empty($pendingRequests)): ?>
                      <h4>Demandes en attente</h4>
                      <div class="friend-grid">
                        <?php foreach ($pendingRequests as $request):
                          $requester = $this->utilisateurDAO->read($request->demandeur);
                        ?>
                          <div class="friend-card">
                            <?php
                            $defaultPhoto = 'assets/images/defaut.jpg'; // Même chemin que le profil
                            if (!empty($requester['photo_profil'])): ?>
                              <img src="data:image/jpeg;base64,<?= base64_encode($requester['photo_profil']) ?>" ...>
                            <?php else: ?>
                              <img src="<?= $defaultPhoto ?>" ...>
                            <?php endif; ?>
                            <h6><?= htmlspecialchars($requester['nom'] . ' ' . $requester['prenom']) ?></h6>
                            <div class="action-buttons">
                              <button class="btn btn-success btn-sm" onclick="gererDemandeAmi(<?= $request->id ?>, 'accepter')">
                                Accepter
                              </button>
                              <button class="btn btn-danger btn-sm" onclick="gererDemandeAmi(<?= $request->id ?>, 'refuser')">
                                Refuser
                              </button>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>

                    <!-- Liste d'amis -->
                    <?php if (!empty($friendsList)): ?>
                      <?php foreach ($friendsList as $friend): ?>
                        <?php
                        $defaultPhoto = 'assets/images/defaut.jpg';
                        ?>
                        <div class="friend-card">
                          <?php if (!empty($friend['photo_profil'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($friend['photo_profil']) ?>" alt="<?= htmlspecialchars($friend['nom']) ?>">
                          <?php else: ?>
                            <img src="<?= $defaultPhoto ?>" alt="Photo par défaut">
                          <?php endif; ?>
                          <h6><?= htmlspecialchars($friend['nom'] . ' ' . $friend['prenom']) ?></h6>
                          <div class="action-buttons">
                            <button class="btn btn-primary btn-sm"
                              onclick="window.location.href='routeur.php?action=conversation&id=<?= $friend['id_user'] ?>'">
                              Message
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="supprimerAmi(<?= $friend['id_user'] ?>)">
                              Supprimer
                            </button>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <p>Aucun ami pour le moment.</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>


            <!-- Photos Tab -->
            <div class="tab-pane fade" id="photos">
              <div class="row">
                <div class="col-md-12">
                  <?php if (!empty($photos)): ?>
                    <div class="photo-grid">
                      <?php foreach ($photos as $photo): ?>
                        <img
                          src="data:image/jpeg;base64,<?= base64_encode($photo['photo']) ?>"
                          alt="Photo publiée le <?= date('d/m/Y', strtotime($photo['created_at'])) ?>"
                          class="img-thumbnail"
                          style="cursor: pointer"
                          onclick="afficherPhotoEnGrand('<?= base64_encode($photo['photo']) ?>')">
                      <?php endforeach; ?>
                    </div>
                  <?php else: ?>
                    <div class="alert alert-info">Aucune photo publiée pour le moment</div>
                  <?php endif; ?>
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
      <form action="routeur.php?action=modifierProfil&id=<?= $utilisateur['id_user'] ?>" method="POST" enctype="multipart/form-data">
        <!-- Champ Nom -->
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $utilisateur['nom'] ?>">

        <!-- Champ Prénom -->
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $utilisateur['prenom'] ?>">

        <!-- Champ Email -->
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= $utilisateur['email'] ?>">

        <!-- Champ Sexe -->
        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe">
          <option value="Homme" <?= $utilisateur['sexe'] == 'Homme' ? 'selected' : '' ?>>Homme</option>
          <option value="Femme" <?= $utilisateur['sexe'] == 'Femme' ? 'selected' : '' ?>>Femme</option>
          <option value="Autre" <?= $utilisateur['sexe'] == 'Autre' ? 'selected' : '' ?>>Autre</option>
        </select>

        <!-- Champ Ville -->
        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" value="<?= isset($utilisateur['ville']) ? $utilisateur['ville'] : ''; ?>">

        <!-- Champ Pays -->
        <label for="pays">Pays :</label>
        <input type="text" id="pays" name="pays" value="<?= isset($utilisateur['pays']) ? $utilisateur['pays'] : ''; ?>">

        <!-- Champ Travail -->
        <label for="travail">Travail :</label>
        <input type="text" id="travail" name="travail" value="<?= isset($utilisateur['travail']) ? $utilisateur['travail'] : ''; ?>">

        <!-- Champ loisirs -->
        <label for="travail">Loisirs :</label>
        <input type="text" id="loisirs" name="loisirs" value="<?= isset($utilisateur['loisirs']) ? $utilisateur['loisirs'] : ''; ?>">

        <!-- Champ Bio -->
        <label for="bio">Bio :</label>
        <textarea id="bio" name="bio"><?= isset($utilisateur['bio']) ? $utilisateur['bio'] : ''; ?></textarea>

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

  <!-- Modal pour afficher les photos en grand -->
  <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="photoModalLabel">Photo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <img id="modalPhoto" src="" class="img-fluid" alt="Photo en grand">
        </div>
      </div>
    </div>
  </div>

<script>
    function afficherPhotoEnGrand(base64Image) {
      const modalPhoto = document.getElementById('modalPhoto');
      modalPhoto.src = 'data:image/jpeg;base64,' + base64Image;
      new bootstrap.Modal(document.getElementById('photoModal')).show();
    }
</script>
<script>
    function Logout() { 
      console.log("rrrrrrrrrrrrrrrrrrrrrrrrrrrrrr");
      
            window.location.href = "routeur.php?action=Logout";
      }

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



    ///////

    function supprimerAmi(amiId) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cet ami ?")) {
        fetch(`controleurs/amie.php?action=supprimer&id=${amiId}`)
          .then(response => {
            if (response.ok) {
              location.reload(); // Recharger la page après suppression
            }
          });
      }
    }

    function gererDemandeAmi(amiId, action) {
      fetch(`controleurs/amie.php?action=${action}&id=${amiId}`)
        .then(response => {
          if (response.ok) {
            location.reload();
          }
        });
    }
  </script>
</body>

</html>
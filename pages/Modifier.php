<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 500px; /* Réduit la largeur du formulaire */
            margin: 20px auto; /* Centre verticalement et horizontalement */
            background: #f8f9fa; /* Couleur de fond douce */
            padding: 20px;
            border-radius: 8px; /* Coins arrondis */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre pour un effet visuel */
        }

        .sidebar {
            height: 100vh;
            position: fixed;
        }

        .card-custom-1 {
            background-color: #055166 !important;
            color: white !important;
        }

        .card-custom-2 {
            background-color: #F37021 !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar">
                <div class="position-sticky">
                    <h3 class="text-center py-3">Admin Panel</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#dashboard">
                                <i class="bi bi-speedometer2"></i> Tableau de Bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#users">
                                <i class="bi bi-people"></i> Gestion des Utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#content">
                                <i class="bi bi-file-earmark-text"></i> Modération des Contenus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#settings">
                                <i class="bi bi-gear"></i> Paramètres
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3">
                    <!-- Tableau de Bord -->
                    <section id="dashboard" class="mb-5">
                        <h2 class="mb-4">Tableau de Bord</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-custom-1 mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Utilisateurs</h5>
                                        <p class="card-text">1,245 aujourd'hui</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-custom-2 mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Publications Signalées</h5>
                                        <p class="card-text">85 en attente</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-custom-1 mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Groupes</h5>
                                        <p class="card-text">450 groupes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Formulaire de Modification -->
                    <section id="modifier">
                        <div class="form-container">
                            <h2 class="text-center mb-4">Modifier l'Utilisateur</h2>
                            <form action="router.php?action=update_user" method="POST">
                                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($user['id_user']); ?>">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_role" class="form-label">Rôle</label>
                                    <select class="form-select" id="id_role" name="id_role">
                                        <option value="1" <?php echo $user['id_role'] == 1 ? 'selected' : ''; ?>>Utilisateur</option>
                                        <option value="2" <?php echo $user['id_role'] == 2 ? 'selected' : ''; ?>>Administrateur</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                <a href="index.php?action=listUsers" class="btn btn-secondary">Annuler</a>
                            </form>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

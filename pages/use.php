<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
        }

        .card-custom-1 {
            background-color: #0998c1 !important;
            color: white !important;
        }

        .card-custom-2 {
            background-color: hsl(0, 95%, 65%); border-color: hsl(0, 95%, 65%) !important;
            color: white !important;
        }

        .table-container {
            margin-top: 20px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #0998c1 !important;
            border-color: #0998c1 !important;
        }

        .btn-danger {
            background-color: hsl(0, 95%, 65%); border-color: hsl(0, 95%, 65%) !important;
            border-color: hsl(0, 95%, 65%); border-color: hsl(0, 95%, 65%) !important;
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
                <section class="my-4">
                    <h2>Gestion des Utilisateurs</h2>

                    <!-- Barre de Recherche -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher un utilisateur">
                        <button class="btn btn-primary" type="button">Rechercher</button>
                    </div>

                    <!-- Filtres -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <select class="form-select">
                                <option value="all">Tous les rôles</option>
                                <option value="admin">Administrateur</option>
                                <option value="user">Utilisateur</option>
                                <option value="moderator">Modérateur</option>
                            </select>
                        </div>
                        <button class="btn btn-danger">Supprimer Sélection</button>
                    </div>

                    <!-- Tableau des Utilisateurs -->
                    <div class="table-container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>id#</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>1</td>
                                    <td>Jean Dupont</td>
                                    <td>jean.dupont@example.com</td>
                                    <td>Utilisateur</td>
                                    <td>2023-01-15</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" style="background-color: #0998c1; border-color: #0998c1; ">Modifier</button>
                                        <button class="btn btn-sm btn-danger" style="background-color: hsl(0, 95%, 65%); border-color: hsl(0, 95%, 65%);">Suspendre</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>2</td>
                                    <td>Marie Curie</td>
                                    <td>marie.curie@example.com</td>
                                    <td>Administrateur</td>
                                    <td>2022-12-10</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" style="background-color: #0998c1; border-color: #0998c1; ">Modifier</button>
                                        <button class="btn btn-sm btn-danger" style="background-color: hsl(0, 95%, 65%); border-color: hsl(0, 95%, 65%);">Suspendre</button>
                                    </td>
                                </tr>
                                <!-- Ajouter d'autres utilisateurs ici -->
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

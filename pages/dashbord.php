<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
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
        background-color: hsl(0, 95%, 65%) !important;
        color: white !important;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar">
                <div class="position-sticky">
                    <h3 class="text-center py-3">Admin Panel</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="routeur.php?action=dashboard">
                                <i class="bi bi-speedometer2"></i> Tableau de Bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="routeur.php?action=listUsers">
                                <i class="bi bi-people"></i> Gestion des Utilisateurs
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Tableau de bord Section -->
                <h2 class="mb-4">Tableau de Bord</h2>

                <section id="dashboard" class="mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-custom-1 mb-3 dashboard-card" data-page="listUsers">
                                <div class="card-body">
                                    <h5 class="card-title">Utilisateurs</h5>
                                    <p class="card-text" id="totalUsers">Chargement...</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom-2 mb-3 dashboard-card" data-page="reported">
                                <div class="card-body">
                                    <h5 class="card-title">Publications Signalées</h5>
                                    <p class="card-text" id="reportedPosts">Chargement...</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom-1 mb-3 dashboard-card" data-page="groups">
                                <div class="card-body">
                                    <h5 class="card-title">Groupes</h5>
                                    <p class="card-text" id="totalGroups">Chargement...</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom-2 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Utilisateurs en ligne</h5>
                                    <p class="card-text" id="onlineUsers">Chargement...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>
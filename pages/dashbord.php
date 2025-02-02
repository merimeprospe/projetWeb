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

    .cursor-pointer {
        cursor: pointer !important;
    }

    .card-custom-1 {
        background-color: #0998c1 !important;
        color: white !important;
    }

    .card-custom-2 {
        background-color: hsl(0, 95%, 65%) !important;
        color: white !important;
    }

    .card-custom-3 {
        background-color: #28a745 !important;
        color: white !important;
    }

    .card-custom-4 {
        background-color: #ff9800 !important;
        color: white !important;
    }

    .card-custom-5 {
        background-color: #6c757d !important;
        color: white !important;
    }

    .card-custom-6 {
        background-color: #673ab7 !important;
        color: white !important;
    }

    .card-custom-7 {
        background-color: #17a2b8 !important;
        color: white !important;
    }

    .card-custom-8 {
        background-color: #dc3545 !important;
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
                        <li class="nav-item">
                            <a class="nav-link text-white" href="routeur.php?action=listPublications">Gestion des
                                Publications</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Tableau de bord Section -->
                <h2 class="mb-4">Tableau de Bord</h2>

                <section id="dashboard" class="mb-5">
                    <div class="row d-flex g-4">

                        <div class="col-md-3 cursor-pointer">
                            <div class="card card-custom-3 dashboard-card cursor-pointer" data-page="listPublications">
                                <div class="card-body cursor-pointer">
                                    <h5 class="card-title cursor-pointer">Les publications</h5>
                                    <ul id="reportedPosts" class="cursor-pointer">Chargement...</ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 cursor-pointer">
                            <div class="card card-custom-3 dashboard-card" data-page="listUsers">
                                <div class="card-body">
                                    <h5 class="card-title">Les utilisateurs</h5>
                                    <ul id="totalUsers">Chargement...</ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-custom-2 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Utilisateurs Suspendus</h5>
                                    <p id="suspendedUsers">Chargement...</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-custom-2 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Utilisateurs en ligne</h5>
                                    <p id="onlineUsers">Chargement...</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom-1 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Utilisateurs Actifs</h5>
                                    <p id="activeUsers">Chargement...</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card card-custom-3 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Nouveaux Inscrits</h5>
                                    <ul id="newUsers">Chargement...</ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom-5 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Taux d'Engagement</h5>
                                    <p id="engagementRate">Chargement...</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom-6 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Groupes Actifs</h5>
                                    <p id="activeGroups">Chargement...</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom-7 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Taille Base de Données</h5>
                                    <p id="databaseSize">Chargement...</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-custom-8 dashboard-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sécurité - Tentatives de Connexion</h5>
                                    <p id="failedLogins">Chargement...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="card card-custom-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Répartition des Rôles</h5>
                                <ul id="roleDistribution">Chargement...</ul>
                            </div>
                        </div>
                    </div>

                    <!-- TABLEAUX STATISTIQUES -->
                    <div class="mt-5">
                        <h3>📊 Détails des Statistiques</h3>

                        <!-- Table Utilisateurs Actifs -->
                        <div class="table-responsive">
                            <h4>Utilisateurs Actifs</h4>
                            <table class="table text-center table-striped w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody id="activeUsersTable"></tbody>
                            </table>
                        </div>

                        <!-- Table Utilisateurs Suspendus -->
                        <div class="table-responsive">
                            <h4>Utilisateurs Suspendus</h4>
                            <table class="table text-center table-striped w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody id="suspendedUsersTable"></tbody>
                            </table>
                        </div>

                        <!-- Table Nouveaux Inscrits -->
                        <div class="table-responsive">
                            <h4>Nouveaux Inscrits</h4>
                            <table class="table text-center table-striped w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Date Inscription</th>
                                    </tr>
                                </thead>
                                <tbody id="newUsersTable"></tbody>
                            </table>
                        </div>

                        <!-- Table Répartition des Rôles -->
                        <div class="table-responsive">
                            <h4>Répartition des Rôles</h4>
                            <table class="table text-center table-striped w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Rôle</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="roleDistributionTable"></tbody>
                            </table>
                        </div>

                        <!-- Table Groupes Actifs -->
                        <div class="table-responsive">
                            <h4>Groups">Groupes Actifs</h4>
                            <table class="table text-center table-striped w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom du Groupe</th>
                                    </tr>
                                </thead>
                                <tbody id="activeGroupsTable"></tbody>
                            </table>
                        </div>

                        <!-- Table Tentatives de Connexion -->
                        <div class="table-responsive">
                            <h4>Sécurité - Tentatives de Connexion</h4>
                            <table class="table text-center table-striped w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="failedLoginsTable"></tbody>
                            </table>
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
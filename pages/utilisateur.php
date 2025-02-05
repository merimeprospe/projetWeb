<?php
if (!isset($users) || !is_array($users)) {
    $users = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

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
        background-color: hsl(0, 95%, 65%);
        border-color: hsl(0, 95%, 65%) !important;
        color: white !important;
    }

    .table-container {
        overflow: hidden;
    }

    .btn-primary {
        background-color: #0998c1 !important;
        border-color: #0998c1 !important;
    }

    .btn-danger {
        background-color: hsl(0, 95%, 65%);
        border-color: hsl(0, 95%, 65%) !important;
        border-color: hsl(0, 95%, 65%);
        border-color: hsl(0, 95%, 65%) !important;
    }

    .table {
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .table tbody tr {
        background-color: #fff;
    }

    .table tbody tr td {
        padding: 12px;
    }

    .btn-info {
        background-color: #0998c1;
        border-color: #0998c1;
    }

    .bg-primary {
        background-color: #0998c1 !important;
        border-color: #0998c1 !important;
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
                        <li class="nav-item"><a class="nav-link text-white" href="routeur.php?action=dashboard">Tableau
                                de Bord</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="routeur.php?action=listUsers">Gestion
                                des Utilisateurs</a></li>
                        <li class="nav-item">

                           

                            <a href="routeur.php?action=listPublications" class="nav-link text-white">Gestion des
                                Publications</a>

                                <a class="nav-link text-white" href="routeur.php?action=Logout">
                                <i class="uil uil-signout"></i> Logout
                            </a>

                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenu Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <section class="my-4">
                    <h2>Gestion des Utilisateurs</h2>

                    <!-- Barre de Recherche -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="searchUserInput"
                            placeholder="Rechercher un utilisateur">
                    </div>

                    <!-- Filtres -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <select class="form-select" id="roleFilter">
                                <option value="all">Tous les rôles</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tableau des Utilisateurs -->
                    <div class="table-container shadow p-3 bg-white rounded">
                        <table class="table table-striped w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody">
                                <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                <tr id="user-<?= htmlspecialchars($user['id_user']); ?>">
                                    <td><?= htmlspecialchars($user['id_user']); ?></td>
                                    <td class="nom"><?= htmlspecialchars($user['nom']); ?></td>
                                    <td class="prenom"><?= htmlspecialchars($user['prenom']); ?></td>
                                    <td class="email"><?= htmlspecialchars($user['email']); ?></td>
                                    <td class="role"><?= htmlspecialchars($user['id_role']); ?></td>
                                    <td class="statut">
                                        <span class="badge <?= $user['is_suspended'] ? 'bg-primary' : 'bg-success'; ?>">
                                            <?= $user['is_suspended'] ? 'Suspendu' : 'Actif'; ?>
                                        </span>
                                    </td>
                                    <td class="d-flex gap-4">
                                        <button class="btn btn-danger edit-btn"
                                            data-id="<?= htmlspecialchars($user['id_user']); ?>"
                                            data-nom="<?= htmlspecialchars($user['nom']); ?>"
                                            data-prenom="<?= htmlspecialchars($user['prenom']); ?>"
                                            data-email="<?= htmlspecialchars($user['email']); ?>"
                                            data-role="<?= htmlspecialchars($user['id_role']); ?>"
                                            data-suspended="<?= $user['is_suspended']; ?>">
                                            Modifier
                                        </button>
                                        <button class="btn btn-warning delete-btn"
                                            data-id="<?= htmlspecialchars($user['id_user']); ?>">
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Aucun utilisateur trouvé</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Modale de confirmation d'édition -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-user-form" action="routeur.php?action=updateUser" method="POST">
                        <input type="hidden" id="edit-user-id" name="id_user">

                        <div class="mb-3">
                            <label for="edit-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="edit-nom" name="nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="edit-prenom" name="prenom" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-role" class="form-label">Rôle</label>
                            <input type="text" class="form-control" id="edit-role" name="id_role" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-is_suspended" class="form-label">Suspendre</label>
                            <select class="form-select" id="edit-is_suspended" name="is_suspended">
                                <option value="0">Actif</option>
                                <option value="1">Suspendu</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale de confirmation de suspension -->
    <div class="modal fade" id="suspendUserModal" tabindex="-1" aria-labelledby="suspendUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suspendUserModalLabel">Suspendre l'Utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir suspendre l'utilisateur <strong id="suspend-username"></strong> ?</p>
                    <p>Email : <em id="suspend-email"></em></p>
                    <input type="hidden" id="suspend-user-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="confirmSuspendBtn">Suspendre</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/user.js"></script>
</body>

</html>
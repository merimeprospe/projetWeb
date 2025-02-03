<?php
if (!isset($publications) || !is_array($publications)) {
    $publications = [];
}
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Publications</title>
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
        background-color: hsl(0, 95%, 65%) !important;
        color: white !important;
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

    .btn-info {
        background-color: #0998c1;
        border-color: #0998c1;
    }

    .bg-danger {
        background-color: #0998c1 !important;
        border-color: #0998c1 !important;
    }

    .table {
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
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
                        <li class="nav-item"><a class="nav-link text-white"
                                href="routeur.php?action=listPublications">Gestion des Publications</a></li>
                        <li class="nav-item">
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
                    <h2>Gestion des Publications</h2>

                    <!-- Tableau des Publications -->
                    <div class="table-container shadow p-3 bg-white rounded">
                        <table class="table text-center table-striped w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Auteur</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="publicationsTableBody">
                                <?php if (!empty($publications)): ?>
                                <?php foreach ($publications as $publication): ?>
                                <tr id="publication-<?= htmlspecialchars($publication['id_pub']); ?>">
                                    <td><?= htmlspecialchars($publication['id_pub']); ?></td>
                                    <td>
                                        <?= '<img class="img-thumbnail" width="100" src="data:image/jpeg;base64,' . base64_encode($publication['photo']) . '" alt="Photo de l\'objet">';?>
                                    </td>
                                    <td><?= htmlspecialchars($publication['Titre']); ?></td>
                                    <td><?= htmlspecialchars($publication['contenu']); ?></td>
                                    <td><?= htmlspecialchars($publication['nom'] . ' ' . $publication['prenom']); ?>
                                    </td>
                                    <td>
                                        <span
                                            class="badge <?= $publication['is_visible'] == 1 ? 'bg-success' : 'bg-danger'; ?>">
                                            <?= $publication['is_visible'] == 1 ? 'Active' : 'Block'; ?>
                                        </span>
                                    </td>

                                    <td>
                                        <button class="btn btn-danger block-btn"
                                            data-id="<?= htmlspecialchars($publication['id_pub']); ?>">Bloquer</button>
                                        <button class="btn btn-success activate-btn"
                                            data-id="<?= htmlspecialchars($publication['id_pub']); ?>">Activer</button>
                                        <button class="btn btn-warning delete-btn"
                                            data-id="<?= htmlspecialchars($publication['id_pub']); ?>">Supprimer</button>
                                        <button class="btn btn-info details-btn"
                                            data-id="<?= htmlspecialchars($publication['id_pub']); ?>">Détails</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Aucune publication trouvée</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Modale de détails de la publication -->
    <div class="modal fade" id="publicationDetailsModal" tabindex="-1" aria-labelledby="publicationDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publicationDetailsModalLabel">Détails de la Publication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="publicationDetailsContent"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/publication.js"></script>
</body>

</html>
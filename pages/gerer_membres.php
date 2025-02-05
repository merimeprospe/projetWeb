<div class="member-management-container">
    <h2>Gestion des membres</h2>
    
    <!-- Ajout de nouveaux membres -->
    <div class="add-members-section">
        <h3>Ajouter des membres</h3>
        <?php foreach ($nonMembres as $utilisateur): ?>
            <div class="user-item">
                <span><?= htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?></span>
                <a href="routeur.php?action=ajouterMembre&id_groupe=<?= $id_groupe ?>&id_user=<?= $utilisateur['id_user'] ?>" 
                   class="btn btn-add">
                    Ajouter
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Liste des membres existants -->
    <div class="current-members-section">
        <h3>Membres actuels</h3>
        <?php foreach ($membres as $membre): ?>
            <div class="member-item">
                <span><?= htmlspecialchars($membre['prenom'] . ' ' . $membre['nom']) ?></span>
                <div class="member-actions">
                    <?php if ($membre['id_user'] !== $adminId): ?>
                        <a href="routeur.php?action=retirerMembre&id_groupe=<?= $id_groupe ?>&id_user=<?= $membre['id_user'] ?>" 
                           class="btn btn-danger">
                            Retirer
                        </a>
                        <a href="routeur.php?action=nommerAdmin&id_groupe=<?= $id_groupe ?>&id_user=<?= $membre['id_user'] ?>" 
                           class="btn btn-warning">
                            Nommer admin
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
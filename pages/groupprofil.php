<!-- app/Views/groups/profile.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($group['nom_groupe'] ?? 'Groupe') ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * { 
      box-sizing: border-box; 
      margin: 0; 
      padding: 0; 
      font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif; 
    }
    
    body { background: #f0f2f5; }

    .container { 
      max-width: 1200px; 
      margin: 0 auto; 
      padding: 20px; 
    }

    .group-header { 
      position: relative; 
      margin-bottom: 60px; 
    }

    .cover-photo { 
      height: 300px; 
      background: #e4e6eb; 
      border-radius: 12px; 
      overflow: hidden; 
      position: relative;
    }

    .cover-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .group-info { 
      position: absolute; 
      bottom: -60px; 
      left: 40px; 
      background: white; 
      padding: 24px; 
      border-radius: 12px; 
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      gap: 12px;
      max-width: 80%;
    }

    .group-info h1 {
      font-size: 2rem;
      color: #1a1a1a;
    }

    .group-actions { 
      margin-top: 80px; 
      display: flex; 
      gap: 12px; 
      flex-wrap: wrap;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 500;
    }

    .btn-primary { 
      background: #1877f2; 
      color: white; 
    }
    
    .btn-primary:hover { background: #166fe5; }

    .btn-danger { 
      background: #dc3545; 
      color: white; 
    }
    
    .btn-danger:hover { background: #c82333; }

    .members-section { 
      background: white; 
      padding: 24px; 
      border-radius: 12px; 
      margin-top: 20px; 
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .member-list { 
      display: grid; 
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); 
      gap: 16px; 
      margin-top: 20px; 
    }

    .member-card { 
      display: flex; 
      align-items: center; 
      padding: 16px; 
      background: #f8f9fa; 
      border-radius: 8px; 
      transition: transform 0.2s ease;
    }

    .member-card:hover {
      transform: translateY(-2px);
    }

    .member-actions { 
      margin-left: auto; 
      display: flex; 
      gap: 12px; 
      align-items: center; 
    }

    .btn-icon { 
      padding: 6px; 
      color: #65676b; 
      cursor: pointer; 
      transition: color 0.2s ease;
    }

    .btn-icon:hover {
      color: #dc3545;
    }

    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 999;
    }

    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: white;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
      z-index: 1000;
      max-width: 500px;
      width: 90%;
      max-height: 90vh;
      overflow-y: auto;
    }

    .modal h3 {
      font-size: 1.5rem;
      margin-bottom: 24px;
      color: #1a1a1a;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #606770;
      font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #dddfe2;
      border-radius: 8px;
      font-size: 1rem;
    }

    .form-actions {
      margin-top: 24px;
      display: flex;
      gap: 12px;
      justify-content: flex-end;
    }

    .member-management-container,
    .publication-management-container {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .user-item,
    .member-item,
    .publication-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px;
      background: #f8f9fa;
      border-radius: 8px;
    }

    .btn-add {
      background: #42b72a;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
    }

    

    .btn-add:hover {
      background: #36a420;
    }

    .btn-warning {
      background: #ffc107;
      color: black;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .group-info {
        left: 20px;
        right: 20px;
        max-width: none;
        bottom: -80px;
      }
      
      .member-list {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="group-header">
      <div class="cover-photo">
        <?php if (!empty($group['photogroupe'])): ?>
          <img src="data:image/jpeg;base64,<?= base64_encode($group['photogroupe']) ?>" alt="Cover photo">
        <?php endif; ?>
      </div>
      <div class="group-info">
        <h1><?= htmlspecialchars($group['nom_groupe'] ?? 'Nom du groupe') ?></h1>
        <p><?= htmlspecialchars($group['description'] ?? 'Aucune description disponible') ?></p>
        <?php if (!empty($admin)): ?>
          <p>Administrateur : <?= htmlspecialchars($admin['prenom'] . ' ' . $admin['nom']) ?></p>
        <?php endif; ?>
      </div>
    </div>

    <div class="group-actions">
      <?php if ($viewData['showJoin']) : ?>
        <form method="POST" action="routeur.php?action=joinGroup&id_groupe=<?= $group['id_groupe'] ?>">
          <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Rejoindre le groupe</button>
        </form>
      <?php endif; ?>

      <?php if ($viewData['showLeave']) : ?>
        <form method="POST" action="routeur.php?action=quitGroup&id_groupe=<?= $group['id_groupe'] ?>">
          <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Quitter le groupe</button>
        </form>
      <?php endif; ?>

      <?php if ($viewData['showAdminPanel']) : ?>
        <button class="btn btn-primary" onclick="toggleAdminModal()">
          <i class="fas fa-cog"></i> Gérer le groupe
        </button>
        <button class="btn btn-primary" onclick="togglemembreModal()">
          <i class="fas fa-users-cog"></i> Gérer les membres
        </button>
        <button class="btn btn-primary" onclick="togglepubModal()">
          <i class="fas fa-newspaper"></i> Gérer les publications
        </button>
      <?php endif; ?>
    </div>

    <div class="members-section">
      <h3>Membres du groupe <span>(<?= count($viewData['members']) ?>)</span></h3>
      <div class="member-list">
        <?php foreach ($viewData['members'] as $member): ?>
          <div class="member-card">
            <span><?= htmlspecialchars($member['prenom'] . ' ' . $member['nom']) ?></span>
            <div class="member-actions">
              <?php if ($viewData['showAdminPanel'] && $member['id_user'] !== $group['id_admin']): ?>
                <a href="routeur.php?action=retirerMembre&id_groupe=<?= $group['id_groupe'] ?>&id_membre=<?= $member['id_user'] ?>" 
                   class="btn-icon"
                   onclick="return confirm('Retirer ce membre ?')">
                  <i class="fas fa-times"></i>
                </a>
              <?php endif; ?>
              <?php if ($member['id_user'] === $group['id_admin']): ?>
                <i class="fas fa-crown" style="color: #ffd700;"></i>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <?php if ($viewData['showAdminPanel']) : ?>
      <div id="adminModal" class="modal">
        <div class="modal-content">
          <h3><i class="fas fa-cog"></i> Gestion du groupe</h3>
          <form method="POST" action="routeur.php?action=modifierGroupe">
            <input type="hidden" name="id_groupe" value="<?= $group['id_groupe'] ?>">
            <div class="form-group">
              <label>Nom du groupe</label>
              <input type="text" name="nom_groupe" value="<?= htmlspecialchars($group['nom_groupe']) ?>">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="description"><?= htmlspecialchars($group['description']) ?></textarea>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
              <button type="button" class="btn btn-danger" 
                      onclick="if(confirm('Supprimer définitivement le groupe ?')) { 
                        window.location='routeur.php?action=supprimerGroupe&id_groupe=<?= $group['id_groupe'] ?>'
                      }">
                <i class="fas fa-trash"></i> Supprimer
              </button>
            </div>
          </form>
        </div>
      </div>

      <div id="adminmembre" class="modal">
        <div class="member-management-container">
          <h3><i class="fas fa-users-cog"></i> Gestion des membres</h3>
          <div class="add-members-section">
            <h4>Ajouter des membres</h4>
            <?php foreach ($viewData['nonMembres'] as $utilisateur): ?>
              <div class="user-item">
                <span><?= htmlspecialchars($utilisateur['prenom'] . ' ' . $utilisateur['nom']) ?></span>
                <a href="routeur.php?action=ajouterMembre&id_groupe=<?= $group['id_groupe'] ?>&id_user=<?= $utilisateur['id_user'] ?>" 
                   class="btn btn-add">
                  <i class="fas fa-user-plus"></i> Ajouter
                </a>
              </div>
            <?php endforeach; ?>
          </div>
  
          <div class="current-members-section">
            <h4>Membres actuels</h4>
            <?php foreach ($viewData['members'] as $membre): ?>
              <div class="member-item">
                <span><?= htmlspecialchars($membre['prenom'] . ' ' . $membre['nom']) ?></span>
                <div class="member-actions">
                  <?php if ($membre['id_user'] !== $group['id_admin']): ?>
                    <a href="routeur.php?action=retirerMembre&id_groupe=<?= $group['id_groupe'] ?>&id_membre=<?= $membre['id_user'] ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('Retirer ce membre ?')">
                      <i class="fas fa-times"></i>
                    </a>
                    <a href="routeur.php?action=nommerAdmin&id_groupe=<?= $group['id_groupe'] ?>&id_user=<?= $membre['id_user'] ?>" 
                       class="btn btn-warning">
                      <i class="fas fa-crown"></i>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div id="adminpub" class="modal">
        <div class="publication-management-container">
          <h3><i class="fas fa-newspaper"></i> Gestion des publications</h3>
          <?php foreach ($viewData['publications'] as $publication): ?>
            <div class="publication-item">
              <div class="publication-content">
                <h4><?= htmlspecialchars($publication['Titre']) ?></h4>
                <p><?= htmlspecialchars($publication['contenu']) ?></p>
                <small><?= date('d/m/Y H:i', strtotime($publication['created_at'])) ?></small>
              </div>
              <a href="routeur.php?action=supprimerPublication&id_publication=<?= $publication['id_pub'] ?>" 
                 class="btn btn-danger"
                 onclick="return confirm('Supprimer définitivement cette publication ?')">
                <i class="fas fa-trash"></i>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

  </div>

  <script>
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    document.body.appendChild(overlay);

    let currentModal = null;

    function toggleModal(modalId) {
      const modal = document.getElementById(modalId);
      modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
      overlay.style.display = modal.style.display === 'block' ? 'block' : 'none';
      currentModal = modal.style.display === 'block' ? modal : null;
    }

    function toggleAdminModal() { toggleModal('adminModal'); }
    function togglemembreModal() { toggleModal('adminmembre'); }
    function togglepubModal() { toggleModal('adminpub'); }

    overlay.addEventListener('click', () => {
      if (currentModal) {
        currentModal.style.display = 'none';
        overlay.style.display = 'none';
        currentModal = null;
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && currentModal) {
        currentModal.style.display = 'none';
        overlay.style.display = 'none';
        currentModal = null;
      }
    });
  </script>
</body>
</html>
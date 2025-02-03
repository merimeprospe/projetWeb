document.addEventListener('DOMContentLoaded', function () {
  /**
   * Charge les statistiques générales du tableau de bord
   */
  function loadDashboardStats() {
    fetch('routeur.php?action=getDashboardStats')
      .then((response) => response.json())
      .then((data) => {
        console.log('Données stats :', data);
        if (data.success) {
          let totalUsersEl = document.getElementById('totalUsers');
          if (totalUsersEl)
            totalUsersEl.textContent = `${data.data.total_users} utilisateurs`;

          let reportedPostsEl = document.getElementById('reportedPosts');
          if (reportedPostsEl)
            reportedPostsEl.textContent = `${data.data.reported_posts} publications`;

          let totalGroupsEl = document.getElementById('totalGroups');
          if (totalGroupsEl)
            totalGroupsEl.textContent = `${data.data.total_groups} groupes`;
        }
      })
      .catch((error) => console.error('❌ Erreur AJAX stats:', error));
  }

  function loadOnlineUsers() {
    fetch('routeur.php?action=getOnlineUsers')
      .then((response) => response.json())
      .then((data) => {
        console.log('Données utilisateurs en ligne :', data);
        let onlineUsersEl = document.getElementById('onlineUsers');
        if (onlineUsersEl) {
          onlineUsersEl.textContent = `${data.data} en ligne`;
        } else {
          console.error("❌ Élément HTML 'onlineUsers' introuvable !");
        }
      })
      .catch((error) => console.error('❌ Erreur AJAX online users:', error));
  }

  /**
   * Charge les acivités des utilisateurs
   */
  function loadUserActivity() {
    fetch('routeur.php?action=getUserActivity')
      .then((response) => response.text())
      .then((text) => {
        console.log('Réponse Activité Utilisateurs:', text);
        return JSON.parse(text);
      })
      .then((data) => {
        if (data.success) {
          document.getElementById(
            'activeUsers'
          ).textContent = `${data.data.active_users} actifs`;
          document.getElementById(
            'suspendedUsers'
          ).textContent = `${data.data.suspended_users} suspendus`;

          // Affichage des nouveaux inscrits
          let newUsersList = data.data.new_users
            .map((user) => `<li>${user.mois} : ${user.inscrits} inscrits</li>`)
            .join('');
          document.getElementById('newUsers').innerHTML = newUsersList;

          // Affichage des rôles
          let rolesList = data.data.role_distribution
            .map((role) => `<li>${role.nom_role} : ${role.total}</li>`)
            .join('');
          document.getElementById('roleDistribution').innerHTML = rolesList;
        }
      })
      .catch((error) => console.error('Erreur AJAX User Activity:', error));
  }

  /**
   * Charge les données du taux d'engagement
   */
  function loadEngagementRate() {
    fetch('routeur.php?action=getEngagementRate')
      .then((response) => response.json())
      .then((data) => {
        console.log("Données Taux d'Engagement :", data);
        let engagementEl = document.getElementById('engagementRate');
        if (engagementEl) {
          let engagementRate = parseFloat(data.data); // Convertir en nombre
          engagementEl.textContent = `Taux : ${engagementRate.toFixed(2)}%`;
        }
      })
      .catch((error) => console.error('❌ Erreur AJAX engagement:', error));
  }

  /**
   * Charge les tentatives de connexion échouées
   */
  function loadFailedLogins() {
    fetch('routeur.php?action=getFailedLogins')
      .then((response) => response.json())
      .then((data) => {
        console.log('Données Sécurité :', data);
        let failedLoginsEl = document.getElementById('failedLogins');
        if (failedLoginsEl) {
          failedLoginsEl.textContent = `Tentatives : ${data.data}`;
        }
      })
      .catch((error) => console.error('❌ Erreur AJAX failed logins:', error));
  }

  /**
   * Charge les acivités des groupes actifs
   */
  function loadActiveGroups() {
    fetch('routeur.php?action=getActiveGroups')
      .then((response) => response.json())
      .then((data) => {
        console.log('Données Groupes Actifs :', data);
        let activeGroupsEl = document.getElementById('activeGroups');
        if (activeGroupsEl) {
          activeGroupsEl.textContent = `Actifs : ${data.data}`;
        }
      })
      .catch((error) => console.error('Erreur AJAX active groups:', error));
  }

  /**
   * Charge la taille de la base de données
   */
  function loadDatabaseSize() {
    fetch('routeur.php?action=getDatabaseSize')
      .then((response) => response.json())
      .then((data) => {
        console.log('Données Taille Base :', data);
        let dbSizeEl = document.getElementById('databaseSize');
        if (dbSizeEl) {
          dbSizeEl.textContent = `Taille : ${data.data} Mo`;
        }
      })
      .catch((error) => console.error('Erreur AJAX database size:', error));
  }

  /**
   * 📌 Remplit un tableau HTML avec des données JSON
   */
  function populateTable(tableId, data, columns) {
    let tableBody = document.getElementById(tableId);
    if (!tableBody) {
      console.error(`❌ Élément HTML '${tableId}' introuvable !`);
      return;
    }

    // Vérification si 'data' contient bien la clé 'data' et si c'est un tableau
    if (!data.success || !Array.isArray(data.data)) {
      console.error(`❌ Données invalides pour '${tableId}':`, data);
      tableBody.innerHTML = `<tr><td colspan="${columns.length}" class="text-center">Aucune donnée disponible</td></tr>`;
      return;
    }

    let rows = data.data
      .map(
        (row) =>
          `<tr>${columns
            .map((col) => `<td>${row[col] || 'N/A'}</td>`)
            .join('')}</tr>`
      )
      .join('');

    tableBody.innerHTML =
      rows.length > 0
        ? rows
        : `<tr><td colspan="${columns.length}" class="text-center">Aucune donnée disponible</td></tr>`;
  }

  // 📌 Utilisateurs Actifs
  function loadActiveUserssTable() {
    fetch('routeur.php?action=getActiveUsers')
      .then((response) => response.json())
      .then((data) => {
        console.log('📌 Utilisateurs Actifs:', data);
        populateTable('activeUsersTable', data, ['id_user', 'nom', 'email']);
      })
      .catch((error) => console.error('❌ Erreur AJAX active users:', error));
  }

  // 📌 Utilisateurs Suspendus
  function loadSuspendedUserssTable() {
    fetch('routeur.php?action=getSuspendedUsers')
      .then((response) => response.json())
      .then((data) => {
        console.log('📌 Utilisateurs Suspendus:', data);
        populateTable('suspendedUsersTable', data, ['id_user', 'nom', 'email']);
      })
      .catch((error) =>
        console.error('❌ Erreur AJAX suspended users:', error)
      );
  }

  // 📌 Nouveaux Inscrits
  function loadNewUserssTable() {
    fetch('routeur.php?action=getNewUsers')
      .then((response) => response.json())
      .then((data) => {
        console.log('📌 Nouveaux Inscrits:', data);
        populateTable('newUsersTable', data, [
          'id_user',
          'nom',
          'date_inscription',
        ]);
      })
      .catch((error) => console.error('❌ Erreur AJAX new users:', error));
  }

  // 📌 Répartition des Rôles
  function loadRoleDistribution() {
    fetch('routeur.php?action=getRoleDistribution')
      .then((response) => response.json())
      .then((data) => {
        console.log('📌 Répartition des Rôles:', data);
        if (data.success && Array.isArray(data.data)) {
          populateTable('roleDistributionTable', data, ['nom_role', 'total']);
        } else {
          console.error(
            "❌ Données invalides reçues pour 'roleDistributionTable'",
            data
          );
        }
      })
      .catch((error) =>
        console.error('❌ Erreur AJAX role distribution:', error)
      );
  }

  // 📌 Groupes Actifs
  function loadActiveGroupssTable() {
    fetch('routeur.php?action=getActiveAllGroups')
      .then((response) => response.json())
      .then((data) => {
        console.log('📌 Groupes Actifs:', data);
        if (data.success && Array.isArray(data.data)) {
          populateTable('activeGroupsTable', data, ['id_groupe', 'nom_groupe']);
        } else {
          console.error(
            "❌ Données invalides reçues pour 'activeGroupsTable'",
            data
          );
        }
      })
      .catch((error) => console.error('❌ Erreur AJAX active groups:', error));
  }

  // 📌 Sécurité - Tentatives de Connexion
  function loadFailedLoginsTable() {
    fetch('routeur.php?action=getFailedLoginsInfo')
      .then((response) => response.json())
      .then((data) => {
        console.log('📌 Tentatives de Connexion:', data);
        populateTable('failedLoginsTable', data, [
          'id',
          'email',
          'status',
          'timestamp',
        ]);
      })
      .catch((error) => console.error('❌ Erreur AJAX failed logins:', error));
  }

  /**
   * Gère la redirection lorsqu'on clique sur une carte du dashboard
   */
  document.querySelectorAll('.dashboard-card').forEach((card) => {
    card.addEventListener('click', function () {
      const page = this.getAttribute('data-page');
      if (page) {
        window.location.href = `routeur.php?action=${page}`;
      }
    });
  });

  // Charger la fonction au démarrage
  // document.addEventListener('DOMContentLoaded', );

  // Charger les données au chargement de la page
  loadUserActivity();
  loadActiveGroups();
  loadDatabaseSize();
  loadFailedLogins();
  loadEngagementRate();
  loadDashboardStats();
  loadOnlineUsers();
  loadFailedLoginsTable();
  loadActiveUserssTable();
  loadSuspendedUserssTable();
  loadNewUserssTable();
  loadRoleDistribution();
  loadActiveGroupssTable();
});

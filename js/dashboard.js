document.addEventListener('DOMContentLoaded', function () {
  /**
   * Charge les statistiques générales du tableau de bord
   */
  function loadDashboardStats() {
    fetch('routeur.php?action=getDashboardStats')
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          document.getElementById(
            'totalUsers'
          ).textContent = `${data.data.total_users} utilisateurs`;
          document.getElementById(
            'reportedPosts'
          ).textContent = `${data.data.reported_posts} signalements`;
          document.getElementById(
            'totalGroups'
          ).textContent = `${data.data.total_groups} groupes`;
        } else {
          console.error('Erreur chargement stats:', data.error);
        }
      })
      .catch((error) => console.error('Erreur AJAX stats:', error));
  }

  /**
   * Charge les utilisateurs en ligne
   */
  function loadOnlineUsers() {
    fetch('routeur.php?action=getOnlineUsers')
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          document.getElementById(
            'onlineUsers'
          ).textContent = `${data.data} en ligne`;
        }
      })
      .catch((error) => console.error('Erreur AJAX online users:', error));
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

  // Charger les données au chargement de la page
  loadDashboardStats();
  loadOnlineUsers();
});

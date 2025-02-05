document.addEventListener('DOMContentLoaded', function () {
  let selectedUserId = null;

  // 📌 Récupération des éléments HTML
  let suspendUserModalEl = document.getElementById('suspendUserModal');
  let editUserModalEl = document.getElementById('editUserModal');
  let confirmSuspendBtn = document.getElementById('confirmSuspendBtn');
  let editUserForm = document.getElementById('edit-user-form');
  let usersTableBody = document.getElementById('usersTableBody');
  let searchInput = document.getElementById('searchUserInput');
  let roleFilter = document.getElementById('roleFilter');

  let suspendUserModal = suspendUserModalEl
    ? new bootstrap.Modal(suspendUserModalEl)
    : null;
  let editUserModal = editUserModalEl
    ? new bootstrap.Modal(editUserModalEl)
    : null;

  // ✅ Charger dynamiquement les rôles depuis la BD
  function loadRoles() {
    if (!roleFilter) return;
    fetch('routeur.php?action=getRoles')
      .then((response) => response.json())
      .then((roles) => {
        roleFilter.innerHTML = '<option value="all">Tous les rôles</option>';
        roles.forEach((role) => {
          let option = document.createElement('option');
          option.value = role.id_role;
          option.textContent = role.nom_role;
          roleFilter.appendChild(option);
        });
      })
      .catch((error) =>
        console.error('❌ Erreur lors du chargement des rôles :', error)
      );
  }

  // ✅ Ouvrir la modale de modification utilisateur
  document.body.addEventListener('click', function (event) {
    let target = event.target;
    if (target.classList.contains('edit-btn')) {
      document.getElementById('edit-user-id').value =
        target.getAttribute('data-id');
      document.getElementById('edit-nom').value =
        target.getAttribute('data-nom');
      document.getElementById('edit-prenom').value =
        target.getAttribute('data-prenom');
      document.getElementById('edit-email').value =
        target.getAttribute('data-email');
      document.getElementById('edit-role').value =
        target.getAttribute('data-role');
      document.getElementById('edit-is_suspended').value =
        target.getAttribute('data-suspended') || '0';

      if (editUserModal) editUserModal.show();
    }
  });

  // ✅ Mise à jour utilisateur via AJAX
  if (editUserForm) {
    editUserForm.addEventListener('submit', function (event) {
      event.preventDefault();

      let formData = new FormData(this);
      fetch('routeur.php?action=updateUser', {
        method: 'POST',
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          console.log('Réponse AJAX reçue :', data);

          if (data.success) {
            let row = document.getElementById('user-' + data.id_user);
            if (row) {
              row.querySelector('.nom').textContent = data.nom;
              row.querySelector('.prenom').textContent = data.prenom;
              row.querySelector('.email').textContent = data.email;
              row.querySelector('.role').textContent = data.id_role;

              // ✅ Mise à jour du statut avec badge coloré
              let statutCell = row.querySelector('.statut');
              statutCell.innerHTML = `<span class="badge ${
                data.is_suspended == 1 ? 'bg-primary' : 'bg-success'
              }">${data.is_suspended == 1 ? 'Suspendu' : 'Actif'}</span>`;
            } else {
              console.error(
                `❌ Impossible de trouver l'utilisateur user-${data.id_user}`
              );
            }
            if (editUserModal) editUserModal.hide();
          } else {
            alert('❌ Erreur lors de la mise à jour.');
          }
        })
        .catch((error) => console.error('❌ Erreur AJAX:', error));
    });
  }

  // ✅ Supprimer un utilisateur via AJAX
  document.body.addEventListener('click', function (event) {
    let target = event.target;
    if (target.classList.contains('delete-btn')) {
      let userId = target.getAttribute('data-id');
      if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
        fetch(`routeur.php?action=deleteUser&id_user=${userId}`, {
          method: 'DELETE',
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              document.getElementById(`user-${userId}`).remove();
              alert('Utilisateur supprimé avec succès !');
            } else {
              alert('❌ Erreur lors de la suppression: ' + data.error);
            }
          })
          .catch((error) => console.error('❌ Erreur AJAX:', error));
      }
    }
  });

  // ✅ Recherche et filtrage en temps réel
  function fetchFilteredUsers() {
    if (!searchInput || !roleFilter) return;
    const searchValue = searchInput.value.trim();
    const roleValue = roleFilter.value;

    fetch(
      `routeur.php?action=searchUsers&query=${searchValue}&role=${roleValue}`
    )
      .then((response) => response.json())
      .then((data) => updateUsersTable(data))
      .catch((error) => console.error('❌ Erreur AJAX:', error));
  }

  if (searchInput) {
    searchInput.addEventListener('input', fetchFilteredUsers);
  }

  if (roleFilter) {
    roleFilter.addEventListener('change', fetchFilteredUsers);
  }

  // ✅ Mise à jour du tableau après recherche
  function updateUsersTable(users) {
    if (!usersTableBody) return;
    usersTableBody.innerHTML = '';

    if (users.length === 0) {
      usersTableBody.innerHTML =
        '<tr><td colspan="7" class="text-center">Aucun utilisateur trouvé</td></tr>';
      return;
    }

    users.forEach((user) => {
      let row = document.createElement('tr');
      row.id = `user-${user.id_user}`;
      row.innerHTML = `
                <td>${user.id_user}</td>
                <td class="nom">${user.nom}</td>
                <td class="prenom">${user.prenom}</td>
                <td class="email">${user.email}</td>
                <td class="role">${user.id_role}</td>
                <td class="statut">
                    <span class="badge ${
                      user.is_suspended == 1 ? 'bg-primary' : 'bg-success'
                    }">
                        ${user.is_suspended == 1 ? 'Suspendu' : 'Actif'}
                    </span>
                </td>
                <td class="d-flex gap-4">
                    <button class="btn btn-danger edit-btn" data-id="${
                      user.id_user
                    }" data-nom="${user.nom}"
                        data-prenom="${user.prenom}" data-email="${
        user.email
      }" data-role="${user.id_role}"
                        data-suspended="${user.is_suspended}">Modifier</button>
                    <button class="btn btn-warning delete-btn" data-id="${
                      user.id_user
                    }">Supprimer</button>
                </td>
            `;
      usersTableBody.appendChild(row);
    });
  }

  // ✅ Charger les rôles au démarrage
  loadRoles();
});

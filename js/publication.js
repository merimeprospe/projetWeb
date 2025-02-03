document.addEventListener('DOMContentLoaded', function () {
  let selectedPublicationId = null;

  // 📌 Récupération des éléments HTML
  let publicationsTableBody = document.getElementById('publicationsTableBody');
  let publicationDetailsModal = new bootstrap.Modal(
    document.getElementById('publicationDetailsModal')
  );

  // ✅ Bloquer une publication
  document.body.addEventListener('click', function (event) {
    let target = event.target;
    if (target.classList.contains('block-btn')) {
      let publicationId = target.getAttribute('data-id');
      if (confirm('Êtes-vous sûr de vouloir bloquer cette publication ?')) {
        fetch(`routeur.php?action=blockPublication&id_pub=${publicationId}`, {
          method: 'POST',
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              let row = document.getElementById(`publication-${publicationId}`);
              if (row) {
                row.querySelector('.badge').className = 'badge bg-danger';
                row.querySelector('.badge').textContent = 'Block';
              }
            } else {
              alert('❌ Erreur lors du blocage de la publication');
            }
          })
          .catch((error) => console.error('❌ Erreur AJAX:', error));
      }
    }
  });

  // ✅ Activer une publication
  document.body.addEventListener('click', function (event) {
    let target = event.target;

    if (target.classList.contains('activate-btn')) {
      let publicationId = target.getAttribute('data-id');
      fetch(`routeur.php?action=activatePublication&id_pub=${publicationId}`, {
        method: 'POST',
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            let row = document.getElementById(`publication-${publicationId}`);
            if (row) {
              row.querySelector('.badge').className = 'badge bg-success';
              row.querySelector('.badge').textContent = 'Active';
            }
          } else {
            alert("❌ Erreur lors de l'activation");
          }
        })
        .catch((error) => console.error('❌ Erreur AJAX:', error));
    }
  });

  // ✅ Supprimer une publication
  document.body.addEventListener('click', function (event) {
    let target = event.target;
    if (target.classList.contains('delete-btn')) {
      let publicationId = target.getAttribute('data-id');
      if (confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')) {
        fetch(`routeur.php?action=deletePublication&id_pub=${publicationId}`, {
          method: 'DELETE',
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              document.getElementById(`publication-${publicationId}`).remove();
              alert('Publication supprimée avec succès !');
            } else {
              alert('❌ Erreur lors de la suppression: ' + data.error);
            }
          })
          .catch((error) => console.error('❌ Erreur AJAX:', error));
      }
    }
  });

  // ✅ Afficher les détails de la publication
  document.body.addEventListener('click', function (event) {
    let target = event.target;
    if (target.classList.contains('details-btn')) {
      let publicationId = target.getAttribute('data-id');
      fetch(`routeur.php?action=getPublicationDetails&id_pub=${publicationId}`)
        .then((response) => {
          if (!response.ok) {
            throw new Error('Réponse réseau non valide');
          }
          return response.text();
        })
        .then((text) => {
          if (!text.trim()) {
            return {
              publication: {
                Titre: 'Titre inconnu',
                contenu: 'Contenu non disponible',
                nom: 'N/A',
                prenom: 'N/A',
                total_likes: 0,
                liked_by: '',
              },
              comments: [],
            };
          }
          return JSON.parse(text);
        })
        .then((data) => {
          if (!data || typeof data !== 'object' || !data.publication) {
            console.warn(
              'Données invalides reçues, utilisation des valeurs par défaut.'
            );
            data = {
              publication: {
                Titre: 'Titre inconnu',
                contenu: 'Contenu non disponible',
                nom: 'N/A',
                prenom: 'N/A',
                total_likes: 0,
                liked_by: '',
              },
              comments: [],
            };
          }

          let content = document.getElementById('publicationDetailsContent');
          let likesSection =
            data.publication.liked_by && data.publication.liked_by.trim() !== ''
              ? `<ul>${data.publication.liked_by
                  .split(', ')
                  .map((like) => `<li>${like}</li>`)
                  .join('')}</ul>`
              : '<p class="text-muted">Cette publication n\'a pas encore reçu de likes.</p>';

          content.innerHTML = `
                    <h4>${data.publication.Titre}</h4>
                    <p>${data.publication.contenu}</p>
                    <h5>Auteur</h5>
                    <p>${data.publication.nom} ${data.publication.prenom}</p>
                    <h5>Commentaires</h5>
                    <ul>
                        ${
                          data.comments &&
                          Array.isArray(data.comments) &&
                          data.comments.length > 0
                            ? data.comments
                                .map((comment) => `<li>${comment.contenu}</li>`)
                                .join('')
                            : '<p class="text-muted">Aucun commentaire disponible.</p>'
                        }
                    </ul>
                    <h5>Likes : ${data.publication.total_likes || 0}</h5>
                    ${likesSection}
                `;
          let publicationDetailsModal = new bootstrap.Modal(
            document.getElementById('publicationDetailsModal')
          );
          publicationDetailsModal.show();
        })
        .catch((error) => console.error('❌ Erreur AJAX:', error));
    }
  });
});

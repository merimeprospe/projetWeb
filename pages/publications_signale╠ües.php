<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications Signalées</title>
    <link rel="stylesheet" href="style.css">

    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background-color: #055166;
    color: white;
    padding: 15px;
    text-align: center;
}

header nav ul {
    list-style-type: none;
    padding: 0;
}

header nav ul li {
    display: inline;
    margin-right: 20px;
}

header nav ul li a {
    color: white;
    text-decoration: none;
}

h1 {
    margin-bottom: 20px;
}

.publications-list {
    margin: 20px;
}

.publication {
    background-color: white;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.publication-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.username {
    font-weight: bold;
}

.date {
    color: gray;
}

.publication-content img {
    width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 5px;
}

.actions {
    margin-top: 10px;
}

button {
    padding: 10px;
    margin-right: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-approve {
    background-color: #055166;
    color: white;
}

.btn-reject {
    background-color: #FF9800;
    color: white;
}

.btn-remove {
    background-color: #F44336;
    color: white;
}

footer {
    text-align: center;
    background-color: #333;
    color: white;
    padding: 10px;
    position: absolute;
    width: 100%;
    bottom: 0;
}

        
    </style>

</head>
<body>
    <header>
        <h1>Publications Signalées</h1>
        <nav>
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="deconnexion.php">Se déconnecter</a></li>
            </ul>
        </nav>
    </header>
    
    <section>
        <h2>Liste des publications signalées</h2>

        <div class="publications-list">
            <!-- Publication 1 -->
            <div class="publication">
                <div class="publication-header">
                    <p class="username">Utilisateur1</p>
                    <span class="date">Posté le 15 janvier 2025</span>
                </div>
                <div class="publication-content">
                    <p>Ceci est le texte de la publication qui a été signalée pour contenu inapproprié.</p>
                    <img src="image-example.jpg" alt="Image de publication">
                </div>
                <div class="actions">
                    <form action="action_publication.php" method="post">
                        <input type="hidden" name="publication_id" value="1">
                        <button type="submit" name="action" value="approve" class="btn btn-approve">Approuver</button>
                        <button type="submit" name="action" value="reject" class="btn btn-reject">Rejeter</button>
                        <button type="submit" name="action" value="remove" class="btn btn-remove">Supprimer</button>
                    </form>
                </div>
            </div>

            <!-- Publication 2 -->
            <div class="publication">
                <div class="publication-header">
                    <p class="username">Utilisateur2</p>
                    <span class="date">Posté le 14 janvier 2025</span>
                </div>
                <div class="publication-content">
                    <p>Autre publication signalée pour spam.</p>
                    <img src="image-example2.jpg" alt="Image de publication">
                </div>
                <div class="actions">
                    <form action="action_publication.php" method="post">
                        <input type="hidden" name="publication_id" value="2">
                        <button type="submit" name="action" value="approve" class="btn btn-approve">Approuver</button>
                        <button type="submit" name="action" value="reject" class="btn btn-reject">Rejeter</button>
                        <button type="submit" name="action" value="remove" class="btn btn-remove">Supprimer</button>
                    </form>
                </div>
            </div>

            <!-- Ajouter d'autres publications ici -->
        </div>
    </section>

    <footer>
        <p>© 2025 Réseau Social. Tous droits réservés.</p>
    </footer>
</body>
</html>

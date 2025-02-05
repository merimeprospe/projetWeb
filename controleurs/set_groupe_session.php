<?php
session_start();

if (isset($_GET['id_groupe'])) {
    $_SESSION['id_groupe'] = intval($_GET['id_groupe']); // Stocke l'ID du groupe en session
    echo "ID du groupe enregistré en session : " . $_SESSION['id_groupe']; // Réponse optionnelle
} else {
    echo "Erreur : Aucun groupe sélectionné.";
}
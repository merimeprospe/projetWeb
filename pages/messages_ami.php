<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .chat-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: 80vh;
        }

        .chat-header {
            background: #0998c1;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header .back-btn {
            background: none;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .chat-header .back-btn:hover {
            text-decoration: underline;
        }

        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 70%;
            word-wrap: break-word;
            position: relative;
            margin-bottom: 10px;
        }

        .message.sent {
            background-color: #0998c1;
            color: white;
            align-self: flex-end;
        }

        .message.received {
            background-color: hsl(13.01deg 79.05% 58.82%);
            color: white;
            align-self: flex-start;
        }

        .message small {
            display: block;
            font-size: 12px;
            opacity: 0.9;
            margin-top: 5px;
            text-align: right;
        }

        .chat-footer {
            padding: 10px;
            background: white;
            display: flex;
            gap: 10px;
            align-items: center;
            border-top: 1px solid #ddd;
        }

        .chat-footer textarea {
            flex: 1;
            resize: none;
            border-radius: 20px;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .chat-footer button {
            background: #0998c1;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .chat-footer button:hover {
            background: #077b9e;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">
            <!-- Bouton retour vers la page de profil -->
            <button class="back-btn" onclick="window.location.href='routeur.php?action=profile'">Retour</button>
            Conversation avec <?= htmlspecialchars($destinataire['nom'] . ' ' . $destinataire['prenom']) ?>
        </div>
        <div class="messages-container" id="messagesContainer">
            <?php foreach ($messages as $message): ?>
                <div class="message <?= $message['id_expediteur'] == $_SESSION['id'] ? 'sent' : 'received' ?>">
                    <p><?= htmlspecialchars($message['contenu']) ?></p>
                    <small><?= date('d/m/Y H:i', strtotime($message['date_envoi'])) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <form action="routeur.php?action=envoyerMessage" method="POST" class="chat-footer">
            <textarea name="contenu" rows="1" placeholder="Écrivez un message..." required></textarea>
            <input type="hidden" name="id_destinataire" value="<?= $id_destinataire ?>">
            <button type="submit">Envoyer</button>
        </form>
    </div>

    <script>
        // Scroll automatique vers le bas pour voir les derniers messages
        let messagesContainer = document.getElementById("messagesContainer");
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
</body>

</html>
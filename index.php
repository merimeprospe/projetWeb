<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/loginStyle.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Connexion</title>
</head>
<body>
    <?php
       if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Vérifier s'il y a une notification à afficher
        if (isset($_SESSION['notification'])) {
            echo " <style>.alerte {
                        display: flex;
                        align-items: center;
                        max-width: fit-content;
                        padding: 0.7rem;
                        transition: all 1s ease;
                        border-radius: 3px; 
                        background-color: #fd282866;
                        color: #fff;
                        border-left: 8px solid rgb(243 5 5);    
                        margin-top: 24px;
                        position: fixed;
                        z-index: 10;
                        opacity: 0;
                        animation: fadeIn 3s forwards;
                    }
                    </style>
                <div class='alerte'>
                    <div style='padding-left: 0.75rem; padding-right: 2.5rem; font-size: 17px;'>
                        ".$_SESSION['notification']."
                    </div>
                    <div class='fermeture' style='width: 1.2rem; height: 1.2rem; cursor: pointer;' id='myButton'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='w-6 h-6'>
                            <path fill-rule='evenodd' d='M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z' clip-rule='evenodd'/>
                        </svg> 
                    </div>
                </div>
                <script>
                    document.getElementById('myButton').addEventListener('click', function() {
                        const alerte = document.querySelector('.alerte');
                        alerte.style.opacity = 0;
                        setTimeout(() => {
                            alerte.style.display = 'none';
                        }, 100);
                    });
                </script>";
        
        
            
            // Supprimer la notification après l'affichage
           unset($_SESSION['notification']);
        }
                
        function generateCsrfToken() {
            if (empty($_SESSION['csrf_token'])) {
                $token = '';
                for ($i = 0; $i < 32; $i++) {
                    $token .= chr(mt_rand(33, 126)); // Génère un caractère aléatoire
                }
                $_SESSION['csrf_token'] = bin2hex($token);
            }
            return $_SESSION['csrf_token'];
        }
        
        $csrf_token = generateCsrfToken();
    ?>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form id="formLogin" action="routeur.php?action=login" method="post">
                    <input  name="login" type="text" placeholder="USERNAME" required/>
                    <input name="pass" type="password" placeholder="PASSWORD" required />
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                    <button class="opacity" style="color: #fff">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a onclick="register()"style="cursor: pointer;">FIRST CONNECTION</a>
                    <a href="">FORGOT PASSWORD</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
        
    </section>
</body>
<script>
    function register() {
    var login = document.forms["formLogin"]["login"].value;
    var pass = document.forms["formLogin"]["pass"].value;
    var token = document.forms["formLogin"]["csrf_token"].value;

    // Regex pour vérifier que l'email se termine par @3il.fr
    var emailPattern = /^[a-zA-Z0-9._%+-]+@3il\.fr$/;

    if (!emailPattern.test(login)) {
        
        alert("L'adresse email doit se terminer par @3il.fr");
        return false;
    }

    window.location.href = "routeur.php?action=register&login=" + login + "&pass=" + pass + "&token=" + token;
}

</script>
</html>

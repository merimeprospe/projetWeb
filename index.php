<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/loginStyle.css" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
    <?php
        session_start();
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
                        Mot de passe ou login incorrect. Veuillez réessayer.
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
    ?>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form id="formLogin" action="routeur.php?action=login" method="post">
                    <input  name="login" type="text" placeholder="USERNAME" />
                    <input name="pass" type="password" placeholder="PASSWORD" />
                    <button class="opacity" style="color: #fff">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a href="">FIRST CONNECTION</a>
                    <a href="">FORGOT PASSWORD</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/loginStyle.css" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form id="formLogin" action="controleurs/login.php" method="post">
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
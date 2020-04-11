<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <div id="container">
        <div id="form">
            <h2>Login Form</h2>
            <form action="login_control.php" method="post" id="login-form">
                <div>
                    <input type="text" class="input-field login" name="login" placeholder="Login">
                </div>
                <div>
                    <input type="password" class="input-field password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn" id="connexion">Connexion</button>
                <button type="submit" class="btn" name="create-compte">S'inscrire pour jouer?</button>
            </form>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
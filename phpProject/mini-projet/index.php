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
            <form action="" method="post" id="login-form">
                <div>
                    <input type="text" class="input-field login" placeholder="Login">
                </div>
                <div>
                    <input type="password" class="input-field password" placeholder="Password">
                </div>
                <button type="submit" class="btn">Connexion</button>
                <button type="submit" class="btn">S'inscrire pour jouer?</button>
            </form>
        </div>
    </div>
</body>
</html>
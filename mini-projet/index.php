<?php
    session_start();
?>
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
                <div class="input-form">
                    <input type="text" class="input-field login" error="login" name="login" placeholder="Login" value="<?php echo @$_SESSION["nom"]; unset($_SESSION["nom"]); ?>">
                    <div id="login" class="error-form">
                        <?php 
                            if(isset($_SESSION["errors"]["login"])){
                                echo $_SESSION["errors"]["login"];
                                unset($_SESSION["errors"]["login"]);
                            } 
                        ?>
                    </div>
                </div>
                <div class="input-form">
                    <input type="password" class="input-field password" error="password" name="password" placeholder="Password">
                    <div id="password" class="error-form">
                        <?php
                            if(isset($_SESSION["errors"]["password"])){
                                echo $_SESSION["errors"]["password"];
                                unset($_SESSION["errors"]["password"]);
                            }
                        ?>
                    </div>
                </div>
                <button type="submit" class="btn" id="connexion">Connexion</button>
                <a href="create-compte.php" class="btn-redirect" name="create-compte">S'inscrire pour jouer?</a>
            </form>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
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
                <div>
                   <h3 class="red">
                        <?php
                            if(isset($_SESSION["errors"])){
                                echo $_SESSION["errors"];
                                unset($_SESSION["errors"]);
                            } 
                        ?>
                   </h3>
                </div>
                <div>
                    <input type="text" class="input-field login" name="login" id="login" placeholder="Login" value="<?php echo @$_SESSION["nom"]; unset($_SESSION["nom"]); ?>">
                </div>
                <div>
                    <input type="password" class="input-field password" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn" id="connexion">Connexion</button>
                <button type="submit" class="btn" name="create-compte">S'inscrire pour jouer?</button>
            </form>
        </div>
    </div>
    <!-- <script src="js/login.js"></script> -->
</body>
</html>
<?php
    session_start();
    if(isset($_POST["deconnexion"])){
        unset($_SESSION["firstname"]);
        unset($_SESSION["lastname"]);
        unset($_SESSION["login"]);
        unset($_SESSION["avatar"]);
        session_destroy();
        header("Location:index.php");
    }
    if(isset($_SESSION["login"]) AND !empty($_SESSION["login"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/user-interface.css">
    <title>Document</title>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <br>
    <div id="user-container">
        <div id="user-header">
            <div>
                <div id="user-profile">
                    <img src="<?= @$_SESSION["avatar"] ?>" alt="Photo de profil de l'utilisateur ">
                </div>
                <h2 id="name">
                    <?= $_SESSION["firstname"]." ".$_SESSION["lastname"] ?>
                </h2>
            </div>
            <h1>BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</h1>
            <div id="deconnexion">
                <form action="#" method="post">
                    <button name="deconnexion" class="deconnexion">Deconnexion</button>
                </form>
            </div>
        </div>
        <div id="user-content">
        </div>
    </div>
</body>
</html>
<?php
    }
?>
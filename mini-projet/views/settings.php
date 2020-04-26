<?php
    session_start();
    if(isset($_POST["admin-deconnexion"])){
        unset($_SESSION["firstname"]);
        unset($_SESSION["lastname"]);
        unset($_SESSION["login"]);
        unset($_SESSION["avatar"]);
        session_destroy();
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../index.php");
    }
    include("../models/database.php");
    if(isset($_SESSION["login"])){
        $login = $_SESSION["login"];
        $is_admins_login_found = false;
        foreach ($data["admins"] as $admin) {
            if($admin["login"] === $login){
                $is_admins_login_found = true;
                break;
            }
        }
        if($is_admins_login_found){
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="shortcut icon" href="../img/logo-QuizzSA.png" type="image/x-icon">
                <link rel="stylesheet" href="../css/index.css">
                <link rel="stylesheet" href="../css/settings.css">
                <link rel="stylesheet" href="../css/liste-question.css">
                <link rel="stylesheet" href="../css/admin-register.css">
                <link rel="stylesheet" href="../css/user-list.css">
                <link rel="stylesheet" href="../css/create-question.css">
                <title>Document</title>
            </head>
            <body>
                <?php
                    include("menu.php");
                ?>
                <div id="container">
                    <div id="blue-topbar">
                        <h1>CREER ET PARAMETRER VOS QUIZZ</h1>
                        <form action="settings.php" method="post">
                            <button class="deconnexion" name="admin-deconnexion">Deconnexion</button>
                        </form>
                    </div>
                    <div id="setting">
                        <div id="profile">
                            <div id="pp">
                                <p class="circle">
                                    <img src="<?= @$_SESSION["avatar"] ?>" alt="Avatar" srcset="">
                                </p>
                                <div id="user-info">
                                    <h1><?= @$_SESSION["firstname"] ?></h1>
                                    <h1><?= @$_SESSION["lastname"] ?></h1>
                                </div>
                            </div>
                            <div id="setting-items">
                                <a href="#liste-question" class="list">Liste Questions</a>
                                <a href="#create" class="add">Creer Admin</a>
                                <a href="#user-list" class="list">Liste joueurs</a>
                                <a href="#create-question" class="add">Creer Questions</a>
                            </div>
                        </div>
                        <div id="displays-pages">
                            <?php
                                include("liste-question.php");
                                include("inscription.php");
                                include("user-list.php");
                                include("create-question.php");
                            ?>
                        </div>
                    </div>
                </div>
                <script src="../js/setting-items.js"></script>
                <script src="../js/login.js"></script>
                <script src="../js/create-question.js"></script>
            </body>
            </html>
<?php
        }
    }
?>
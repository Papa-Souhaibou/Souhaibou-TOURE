<?php
    session_start();
    include("database.php");
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
                <link rel="stylesheet" href="css/index.css">
                <link rel="stylesheet" href="css/settings.css">
                <link rel="stylesheet" href="css/liste-question.css">
                <link rel="stylesheet" href="css/admin-register.css">
                <title>Document</title>
            </head>
            <body>
                <?php
                    include("menu.php");
                ?>
                <div id="container">
                    <div id="blue-topbar">
                        <h1>CREER ET PARAMETRER VOS QUIZZ</h1>
                        <form action="" method="post">
                            <button class="deconnexion" name="deconnexion">Deconnexion</button>
                        </form>
                        <?php
                            if(isset($_POST["deconnexion"])){
                                unset($_SESSION["firstname"]);
                                unset($_SESSION["lastname"]);
                                unset($_SESSION["login"]);
                                unset($_SESSION["avatar"]);
                                header("Location:index.php");
                            }
                        ?>
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
                                <a href="settings.php?page=list-question" class="list">Liste Questions</a>
                                <a href="settings.php?page=create-admin" class="add">Creer Admin</a>
                                <a href="settings.php?page=user-list" class="list">Liste joueurs</a>
                                <a href="settings.php?page=create-questions" class="add">Creer Questions</a>
                            </div>
                        </div>
                        <div id="displays">
                            <?php
                                $page = isset($_GET["page"]) ? $_GET["page"] : "home";
                                if ($page === "list-question" OR $page === "home") {
                                    include("liste-question.php");
                                }
                                if($page === "create-admin"){
                                    include("inscription.php");
                                }
                                elseif ($page === "user-list") {
                                    include("user-list.php");
                                }elseif($page === "create-questions"){
                                    include("create-question.php");
                                }
                                
                            ?>
                        </div>
                    </div>
                </div>
                <script src="js/setting-items.js"></script>
                <script src="js/login.js"></script>
            </body>
            </html>
<?php
        }
    }
?>
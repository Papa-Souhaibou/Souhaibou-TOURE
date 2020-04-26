<?php
    session_start();
    if(isset($_POST["deconnexion"])){
        unset($_SESSION["firstname"]);
        unset($_SESSION["lastname"]);
        unset($_SESSION["login"]);
        unset($_SESSION["avatar"]);
        unset($_SESSION["score"]);
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../index.php");
    }
    if(isset($_SESSION["login"]) AND !empty($_SESSION["login"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/user-interface.css">
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
            <div id="game-space">
                <div id="info-game">
                    <h1>Question 1/5:</h1>
                    <h3>Les langages Web</h3>
                </div>
            </div>
            <div id="dashboard">
                <div id="dashboard-menu">
                    <ul class="tabs">
                        <li class="active"><a href="#top-score">Top Scores</a></li>
                        <li><a href="#mon-score">Mon meilleur score</a></li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div class="tab-content active" id="top-score">
                        <table>
                        <?php
                            include_once("../models/database.php");
                            usort($data["users"],function ($a,$b){
                                return $a["score"] < $b["score"];
                            });
                            $sotedArray = $data["users"];
                            $size = count($data["users"]);
                            for ($i=0; $i < 5; $i++) { 
                            ?>
                            <tr>
                                <td><?= $sotedArray[$i]["firstname"]." ".$sotedArray[$i]["lastname"] ?></td>
                                <td class="score"><?= $sotedArray[$i]["score"]." pts" ?></td>
                            </tr>
                            <?php
                            }
                        ?>
                        </table>
                    </div>
                    <div class="tab-content" id="mon-score">
                        <table>
                            <tr>
                                <td><?= $_SESSION["firstname"]." ".$_SESSION["lastname"] ?></td>
                                <td class="score"><?= $_SESSION["score"]." pts" ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/user-interface.js"></script>
</body>
</html>
<?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/create-compte.css">
    <title>Document</title>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <div id="container">
        <div id="blue-topbar">
            <h1>CREER ET PARAMETRER VOS QUIZZ</h1>
            <button class="deconnexion">Deconnexion</button>
        </div>
        <div id="setting">
            <div id="profile">
                <div id="pp">
                    <p class="circle">
                        <img src="" alt="" srcset="">
                    </p>
                    <div id="user-info">
                        <h1>AAA</h1>
                        <h1>BBB</h1>
                    </div>
                </div>
                <div id="setting-items">
                    <table>
                        <tr>
                            <td><a href="settings.php?page=list-question">Liste Questions</a></td>
                            <td><a href="settings.php?page=list-question"><img src="img/icones/ic-liste.png" class="list" alt="icone liste"></a></td>
                        </tr>
                        <tr>
                            <td><a href="settings.php?page=create-compte">Creer Admin</a></td>
                            <td><a href="settings.php?page=create-compte"><img src="img/icones/ic-ajout.png" class="add" alt="icone ajout"></a></td>
                        </tr>
                        <tr>
                            <td><a href="settings.php?page=user-list">Liste joueurs</a></td>
                            <td><a href="settings.php?page=user-list"><img src="img/icones/ic-liste.png" class="list" alt="icone liste"></a></td>
                        </tr>
                        <tr>
                            <td><a href="settings.php?page=create-questions">Creer Questions</a></td>
                            <td><a href="settings.php?page=create-questions"><img src="img/icones/ic-ajout.png" class="add" alt="icone ajout"></a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="displays">
                <?php
                    $page = isset($_GET["page"]) ? $_GET["page"] : "home";
                    if($page === "create-compte"){
                        include("inscription.php");
                    }
                    elseif ($page === "user-list") {
                        echo "Page Liste user";
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="js/setting-items.js"></script>
</body>
</html>
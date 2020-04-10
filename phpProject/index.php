<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf/exo_8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Projet PHP</title>
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href="index.php?p=exo_1">Exercice 1</a></li>
            <li><a href="index.php?p=exo_2">Exercice 2</a></li>
            <li><a href="index.php?p=exo_3">Exercice 3</a></li>
            <li><a href="index.php?p=exo_4">Exercice 4</a></li>
            <li><a href="index.php?p=exo_5">Exercice 5</a></li>
            <li><a href="App1/app_1.php">Application 1</a></li>
            <li><a href="App2/app_2.php">Application 2</a></li>
        </ul>
    </div>
    <div id="container">
        <div class="content">
            <?php 
                if(isset($_GET["p"])){
                    $p = $_GET["p"];
                }else{
                    $p = "index";
                }
                if($p === "exo_1"){
                    include("exo_1/exercice_1.php");
                }
                elseif($p === "exo_2"){
                    include("exo_2/exercice_2.php");
                }
                elseif($p === "exo_3"){
                    include("exo_3/exercice_3.php");
                }
                elseif($p === "exo_4"){
                    include("exo_4/exercice_4.php");
                }
                elseif($p === "exo_5"){
                    include("exo_5/exercice_5.php");
                }
            ?>
        </div>
    </div>

</body>
</html>
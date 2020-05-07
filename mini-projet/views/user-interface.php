<?php
    include_once("../models/database.php");
    if(isset($_POST["deconnexion"])){
        unset($_SESSION["firstname"]);
        unset($_SESSION["lastname"]);
        unset($_SESSION["login"]);
        unset($_SESSION["avatar"]);
        unset($_SESSION["score"]);
        session_destroy();
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
        include_once("../models/questions.php");
        $data = get_our_contents_file("../js/database.json");
        $questions = get_our_contents_file();
        $questions_size = count($questions);
        $number_question = $data["number"];
        $this_user = get_this_user($data["users"],$_SESSION["login"]);
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
        <?php
            if(isset($_GET["question"]))
            {
                $question_actuelle = (int) $_GET["question"];
                if($question_actuelle > $number_question){
                    $question_actuelle = $number_question;
                }else if($question_actuelle <= 0){
                    $question_actuelle = 1;
                }
            }else{
                $question_actuelle = 1;
            }
            $selected_question_index = rand(0,$questions_size-1);
            if(!empty($_SESSION["previous"]))
                $previous = array_values($_SESSION["previous"]);
            else {
                $_SESSION["previous"][$question_actuelle] = $selected_question_index;
                $previous = array_values($_SESSION["previous"]);
            }
            if(!empty($_SESSION["goodAnswers"])){
                $goodAnswers =  $this_user["goodAnswers"];
                if(count($goodAnswers) < $questions_size)
                    while((in_array($questions[$selected_question_index]["enonce"],$_SESSION["goodAnswers"]) 
                    || in_array($questions[$selected_question_index]["enonce"],$this_user["goodAnswers"])) || in_array($selected_question_index,$previous)){
                        $selected_question_index = rand(0,$questions_size-1); 
                    }
                else {
                    echo "<h1>Vous avez repondu A toute les question</h1>";
                    die();
                }
            }
            if(!isset($_SESSION["previous"][$question_actuelle]))
                $_SESSION["previous"][$question_actuelle] = $selected_question_index;
            $previous_page = (int)$_SESSION["previous"][$question_actuelle];
        ?>
            <div id="game-space">
            <?php
                if(!isset($_SESSION["finished"])){
                    $_SESSION["finished"] = false;
                }
                if(!$_SESSION["finished"]){
                    
                ?>
                <div id="info-game">
                    <h1>Question <?= $question_actuelle."/".$number_question ?>:</h1>
                    <?php
                        echo "<h3>".$questions[$previous_page]["enonce"]."</h3>";
                    ?>
                    <form action="../controller/check_questions.php?question=<?= $question_actuelle ?>" method="post">
                        <button type="submit" name="quit">Quittez</button>
                    </form>
                </div>
                <div id="questionnaire">
                    <form action="../controller/check_questions.php?question=<?= $question_actuelle ?>" method="post">
                    <input type="hidden" name="hidden" value="<?= $questions[$previous_page]["enonce"] ?>">
                    <?php
                        if($questions[$previous_page]["typeReponse"] === "radio"){
                            foreach ($questions[$previous_page]["choix"] as $key => $value) {
                                $is_checked = false;
                                if(isset($_SESSION["radio"])){
                                    foreach ($_SESSION["radio"] as $radio) {
                                        if($value === $radio){
                                            $is_checked = true;
                                        }
                                    }
                                }
                                if($is_checked){
                                ?>
                                <div class="reponses_question">
                                    <input type="radio" name="radio" id="<?= $key ?>" value="<?= $value ?>" checked>
                                    <label for="<?= $key ?>"><?= $value ?></label>
                                </div>
                                <?php
                                }
                                else {
                                ?>
                                <div class="reponses_question">
                                    <input type="radio" name="radio" id="<?= $key ?>" value="<?= $value ?>">
                                    <label for="<?= $key ?>"><?= $value ?></label>
                                </div>
                                <?php
                                }
                            }
                        }else if ($questions[$previous_page]["typeReponse"] === "checkbox"){
                            foreach ($questions[$previous_page]["choix"] as $key => $value) {
                            ?>
                            <div class="reponses_question">
                                <?php
                                    $is_checked = false;
                                    if(isset($_SESSION["checkbox"][$question_actuelle])){
                                        foreach($_SESSION["checkbox"][$question_actuelle] as $checkbox){
                                            if($value === $checkbox){
                                                $is_checked = true;
                                            }
                                        }
                                    }
                                    if($is_checked){
                                    ?>
                                        <input type="checkbox" name="checkbox[]" id="<?= $key ?>" value="<?= $value ?>" checked>
                                        <label for="<?= $key ?>"><?= $value ?></label>
                                    <?php
                                    }else{
                                    ?>
                                        <input type="checkbox" name="checkbox[]" id="<?= $key ?>" value="<?= $value ?>">
                                        <label for="<?= $key ?>"><?= $value ?></label>
                                    <?php
                                    }
                                ?>
                            </div>
                            <?php
                            }
                        }elseif ($questions[$previous_page]["typeReponse"] === "text") {
                            if(isset($_SESSION["text"][$question_actuelle])){
                            ?>
                            <div class="reponses_question">
                                <label for="<?= $question_actuelle - 1 ?>">Votre reponse : </label>
                                <input type="text" name="text" id="<?= $question_actuelle - 1 ?>" value="<?= $_SESSION["text"][$question_actuelle] ?>">
                            </div>
                            <?php
                            }else{
                            ?>
                            <div class="reponses_question">
                                <label for="<?= $question_actuelle - 1 ?>">Votre reponse : </label>
                                <input type="text" name="text" id="<?= $question_actuelle - 1 ?>">
                            </div>
                            <?php
                            }
                        }
                    ?>
                        <div id="direction">
                        <?php
                            if($question_actuelle > 1){
                                echo '<a href="user-interface.php?question='.($question_actuelle-1).'" class="previous_question">precedent</a>';
                            }
                            if($question_actuelle >= 1 AND $question_actuelle+1 <= $number_question){
                                echo '<button class="next_question">Suivant</button>';
                            }
                            if($question_actuelle === $number_question){
                                echo '<button name="finished" class="next_question">terminer</button>';
                            }
                        ?>
                        </div>
                    </form>
                </div>
                <?php
                }
                else if($_SESSION["finished"]){
                    if(isset($_GET["finished"]))
                    {
                        $finished = (int) $_GET["finished"];
                        if($question_actuelle > 2){
                            $finished = 2;
                        }else if($finished <= 0){
                            $finished = 1;
                        }
                    }else{
                        $finished = 1;
                    }
                    if($finished === 1){
                        if(isset($_SESSION["goodAnswers"])){
                            echo "<h2>Les questions que vous avez trouvees</h2>";
                            if(isset($_SESSION["goodAnswers"])){
                                foreach( $_SESSION["goodAnswers"] as $value) {
                                    $question = get_question_by_enonce($questions,$value);
                                    echo "<div class='results'>";
                                    echo "<h3>$question[enonce]</h3>";
                                    if($question["typeReponse"] === "text"){
                                        echo '<input type="text" name="" id="" value="'.$question["reponse"].'" disabled><br/>';
                                    }elseif ($question["typeReponse"] === "radio") {
                                        foreach ($question["choix"] as $choice) {
                                            if($choice === $question["reponse"]){
                                                echo '<input type="radio" name="" id="" checked disabled>';
                                                echo "<label >$choice</label><br/>";
                                            }else {
                                                echo '<input type="radio" name="" id="" disabled>';
                                                echo "<label >$choice</label><br/>";
                                            }
                                        }
                                    }elseif ($question["typeReponse"] === "checkbox") {
                                        foreach ($question["choix"] as $choice) {
                                            if(in_array($choice,$question["reponse"])){
                                                echo '<input type="checkbox" name="" id="" checked disabled>';
                                                echo "<label >$choice</label><br/>";
                                            }else {
                                                echo '<input type="checkbox" name="" id="" disabled>';
                                                echo "<label >$choice</label><br/>";
                                            }
                                        }
                                    }
                                    echo "</div>";
                                }
                            }
                        }
                        else{
                            echo "<center style='margin-top:15px'><h2>Vous n'avez pas encore joue</h2></center>";
                        }
                        echo "<br><br>";
                        echo '<a style="margin-left:25px" href="user-interface.php?question='.($question_actuelle).'&finished=2" class="previous_question">Suivant</a>';
                        echo "<br>";
                    }elseif ($finished === 2) {
                        if(isset($_SESSION["badAnswers"])){
                            echo "<center style='margin-top:15px'><h2>Les questions que vous avez faussees</h2></center>";
                            foreach ($_SESSION["badAnswers"] as $badAnswer) {
                                echo '<div class="results">';
                                echo "<h3>$badAnswer</h3>";
                                echo '</div>';
                            }
                        }
                        echo "<br><br>";
                        echo "<center style='margin-top:15px'><h3>Votre score est de : $_SESSION[score]/$_SESSION[total]</h3></center>";
                        unset($_SESSION["goodAnswers"]);
                        unset($_SESSION["badAnswers"]);
                        unset($_SESSION["previous"]);
                        unset($_SESSION["finished"]);
                        unset($_SESSION["score"]);
                        unset($_SESSION["total"]);
                        echo "<br><br>";
                        echo '<a style="margin-left:25px" href="user-interface.php?question='.(1).'" class="previous_question">Termine</a>';
                        echo "<br>";
                    }
                }
            ?>
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
                                <td class="score"><?= $this_user["score"]." pts" ?></td>
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
    }else {
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../index.php");
    }
?>
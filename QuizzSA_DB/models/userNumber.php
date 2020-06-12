<?php
    include_once("../models/databaseAccess.php");
    if(isset($_POST["nbrQuestion"])){
        $request = "SELECT nombreQuestion FROM partie WHERE idPartie = 1";
        $response = $db->query($request);
        $number = $response->fetch(PDO::FETCH_ASSOC);
        echo json_encode($number);
    }elseif (isset($_POST["scoreModification"])) {
        $score = (int)$_POST["score"];
        $idJoueur = (int)$_POST["idJoueur"];
        $playerManager->updateScore($score,$idJoueur);
    }else{
        $response = $db->query("SELECT COUNT(*) number FROM joueurs");
        $number = $response->fetch(PDO::FETCH_ASSOC);
        echo json_encode($number);
    }
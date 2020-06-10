<?php
    include_once("../models/databaseAccess.php");
    global $playerManager;
    if(isset($_POST["status"])){
        $idPlayer = (int)$_POST["idPlayer"];
        $status = $_POST["status"];
        $playerManager->setStatus($idPlayer,$status);
        $player = $playerManager->getPlayer($idPlayer);
        echo json_encode($player);
    }else if(isset($_POST["delete"])){
        $idPlayer = (int) $_POST["idPlayer"];
        $playerManager->deletePlayer($idPlayer);
        echo "success";
    }else if($_POST["score"]){
        $request = "SELECT prenomJoueur,nomJoueur, MAX(ScoreJoueur) as MeilleurScore, ScoreJoueur FROM joueurs  GROUP BY(idJoueur) ORDER BY(ScoreJoueur) DESC LIMIT 0, 5";
        $response = $db->query($request);
        $players = [];
        while($data = $response->fetch(PDO::FETCH_ASSOC)){
            $player = new Player($data);
            $players[] = $player;
        }
        $response->closeCursor();
        echo json_encode($players);
    }
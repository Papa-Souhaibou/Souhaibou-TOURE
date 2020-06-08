<?php
    include_once("../models/databaseAccess.php");
    global $playerManager;
    if(isset($_POST["status"])){
        $idPlayer = (int)$_POST["idPlayer"];
        $status = $_POST["status"];
        $playerManager->setStatus($idPlayer,$status);
        $player = $playerManager->getPlayer($idPlayer);
        echo json_encode($player);
    }if(isset($_POST["delete"])){
        $idPlayer = (int) $_POST["idPlayer"];
        $playerManager->deletePlayer($idPlayer);
        echo "success";
    }
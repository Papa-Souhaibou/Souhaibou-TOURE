<?php
    include_once("../models/databaseAccess.php");
    if(isset($_POST["login"])){
        $login = htmlspecialchars($_POST["login"]);
        $player = $playerManager->getPlayer($login);
        if($player){
            $player = json_encode($player);
            echo $player;
        }else{
            $admin = $adminManager->getAdmin($login);
            if($admin){
                $admin = json_encode($admin);
                echo $admin;
            }else {
                echo json_encode(["error" => "notFound"]);
            }
        }
    }else{
        $limit = (int)$_POST["limit"];
        $offset = (int)$_POST["offset"];
        $players = $playerManager->getListUser(false,$limit,$offset);
        echo json_encode($players);
    }
?>
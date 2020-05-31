<?php
    include_once("../models/databaseAccess.php");
    if(isset($_POST["login"])){
        $login = htmlspecialchars($_POST["login"]);
        $player = $playerManager->getPlayer($login);
        if($player){
            $player = json_encode($player->jsonSerialize());
            echo $player;
        }else{
            $admin = $adminManager->getAdmin($login);
            if($admin){
                $admin = json_encode($admin->jsonSerialize());
                echo $admin;
            }else {
                echo json_encode(["error" => "notFound"]);
            }
        }
    }
?>
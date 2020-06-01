<?php
    include_once("../models/databaseAccess.php");
    if(isset($_POST["password"])){
        $password = $_POST["password"];
        $login = $_POST["login"];
        $admin = $adminManager->getAdmin($login);
        if($admin){
            $result = password_verify($password,$admin->getPasswordAdmin()) ? "true":"false";
            echo $result;
        }else {
            $player = $playerManager->getPlayer($login);
            $result = password_verify($password,$player->getPasswordJoueur()) ? "true":"false";
            echo $result;
        }
    }
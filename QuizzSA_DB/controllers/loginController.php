<?php
    require_once("../models/Autoloader.class.php");
    require_once("../models/databaseAccess.php");
    session_start();
    Autoloader::register();
    $playerManager = new PlayerManager($db);
    $adminManager = new AdminManager($db);
    function getConnexion(String $login){
        global $playerManager,$adminManager;
        if($playerManager->getPlayer($login)){
            return "player";
        }
        if($adminManager->getAdmin($login)){
            return  "admin";
        }
    }
    if(isset($_POST["submit"])){
        $login = htmlspecialchars($_POST["login"]);
        $password = $_POST["password"];
        $hasError = false;
        if(empty($login)){
            $_SESSION["loginError"] = "Ce champs est obligatoire";
            $hasError = true;
        }
        if(empty($password)){
            $_SESSION["passwordError"] = "Ce champs est obligatoire";
            $hasError = true;
        }
        if(getConnexion($login) === "player"){
            $player = $playerManager->getPlayer($login);
            var_dump($player);
            if($player->getPasswordJoueur() === $password){
                header("Location:../views/playerInterface.php");
            }else{
                $_SESSION["passwordError"] = "Mot de passe incorrecte";
                $hasError = true;
            }
        }
        if(getConnexion($login) === "admin"){
            $admin = $adminManager->getAdmin($login);
            if($admin->getPasswordAdmin() === $password){
                header("Location:../views/adminInterface.php");
            }else {
                $_SESSION["passwordError"] = "Mot de passe incorrecte";
                $hasError = true;
            }
        }
        if($hasError){
            header("Location:../index.php");
        }
    }

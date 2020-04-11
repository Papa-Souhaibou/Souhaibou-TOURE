<?php
    session_start();
    if(!empty($_POST["login"]) AND !empty($_POST["password"])){
        $login = strip_tags($_POST["login"]);
        $password = $_POST["password"];
        include_once("database.php");
        foreach ($data["admins"] as $admin) {
            if($admin["login"] === $login AND $password === $admin["password"]){
                $_SESSION["login"] = $login;
                $_SESSION["firstname"] = $admin["firstname"];
                $_SESSION["lastname"] = $admin["lastname"];
                $_SESSION["avatar"] = $admin["avatar"];
                header("Location:settings.php");
            }
        }
        foreach ($data["users"] as $user) {
            if($user["login"] === $login AND $password === $user["password"]){
                $_SESSION["login"] = $login;
                $_SESSION["firstname"] = $user["firstname"];
                $_SESSION["lastname"] = $user["lastname"];
                $_SESSION["avatar"] = $user["avatar"];
                header("Location:user-interface.php");
            }
        }
    }
    if(isset($_POST["create-compte"])){
        header("Location:create-compte.php");
    }
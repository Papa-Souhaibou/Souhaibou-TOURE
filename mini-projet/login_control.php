<?php
    if(!empty($_POST["login"]) AND !empty($_POST["password"])){
        include_once("database.php");
        $login = strip_tags($_POST["login"]);
        $password = $_POST["password"];
        $password = password_hash($password,PASSWORD_DEFAULT);
        foreach ($data["admins"] as $value) {
            if($value['login'] === $login AND password_verify($value["password"],$password)){
                session_start();
                $_SESSION["login"] = $login;
                header("Location:settings.php");
            }
        }
        foreach ($data["users"] as $value) {
            if($value['login'] === $login AND password_verify($value["password"],$password)){
                session_start();
                $_SESSION["login"] = $login;
                header("Location:create-compte.php");
            }
        }
    }
    else if(isset($_POST["create-compte"])){
        header("Location:create-compte.php");
    }
    else
        header("Location:index.php");
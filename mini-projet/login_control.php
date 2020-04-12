<?php
    session_start();
    if(empty($_POST["login"]) OR empty($_POST["password"])){
        $_SESSION["errors"] = "Tout les champs sont obligatoires.";
        header("Location:index.php");
    }
    else if(!empty($_POST["login"]) AND !empty($_POST["password"])){
        $_SESSION["nom"] = $_POST["login"];
        $login = strip_tags($_POST["login"]);
        $password = $_POST["password"];
        $is_this_user_in_admins_group = false;
        $is_this_user_in_users_group = false;
        include_once("database.php");
        foreach ($data["admins"] as $admin) {
            if($admin["login"] === $login){
                $is_this_user_in_admins_group = true;
                if($password === $admin["password"]){
                    $_SESSION["login"] = $login;
                    $_SESSION["firstname"] = $admin["firstname"];
                    $_SESSION["lastname"] = $admin["lastname"];
                    $_SESSION["avatar"] = $admin["avatar"];
                    header("Location:settings.php");
                }
                else {
                    $_SESSION["errors"] = 'Login et/ou mot de passe incorrecte.';
                    header("Location:index.php");
                }
            }
        }
        if(!$is_this_user_in_admins_group){
            foreach ($data["users"] as $user) {
                if($user["login"] === $login){
                    $is_this_user_in_users_group = true;
                    if($password === $user["password"]){
                        $_SESSION["login"] = $login;
                        $_SESSION["firstname"] = $user["firstname"];
                        $_SESSION["lastname"] = $user["lastname"];
                        $_SESSION["avatar"] = $user["avatar"];
                        header("Location:user-interface.php");
                    }
                    else {
                        $_SESSION["errors"] = 'Login et/ou mot de passe incorrecte.';
                        header("Location:index.php");
                    }
                }
            }
        }
        if(!$is_this_user_in_admins_group AND !$is_this_user_in_users_group){
            $_SESSION["errors"] = 'Compte innexistant';
            header("Location:index.php");
        }
    }
    if(isset($_POST["create-compte"])){
        header("Location:create-compte.php");
    }
<?php
    include_once("../models/database.php");
    include_once("../models/questions.php");
    $_SESSION["errors"] = [
        "login" => "",
        "password" => ""
    ];
    if(!empty($_POST["login"]) AND !empty($_POST["password"])){
        $_SESSION["nom"] = $_POST["login"];
        $login = strip_tags($_POST["login"]);
        $password = $_POST["password"];
        $databaseUrl = "../js/database.json";
        $not_in_admins_group = false;
        $not_in_users_group = false;
        $data = get_our_contents_file($databaseUrl);
        $connexion = get_connexion($data,$login,$password,"admins","../views/settings.php");
        if($connexion === "../views/settings.php"){
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../views/settings.php");
        }elseif ($connexion === "password-error") {
            $_SESSION["errors"]["password"] = "Mot de passe incorrecte.";
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../index.php");
        }elseif ($connexion === "not-exist") {
            $not_in_admins_group = true;
        }
        $connexion = get_connexion($data,$login,$password,"users","../views/user-interface.php");
        if($connexion === "../views/user-interface.php"){
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../views/user-interface.php");
        }elseif($connexion === "password-error"){
            $_SESSION["errors"]["password"] = "Mot de passe incorrecte.";
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../index.php");
        }elseif ($connexion === "not-exist") {
            $not_in_users_group = true;
        }
        if($not_in_admins_group AND $not_in_users_group){
            $_SESSION["errors"]["login"] = 'Compte innexistant';
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../index.php");
        }
        
    }
    if(isset($_POST["create-compte"])){
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../views/create-compte.php");
    }
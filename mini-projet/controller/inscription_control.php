<?php
    include_once("../models/database.php");
    include_once("../models/questions.php");
    $data = get_our_contents_file("../js/database.json");
    if(isset($_SESSION["login"])){
        $is_admins_login_found = false;
        foreach ($data["admins"] as $admin) {
            if($admin["login"] === $_SESSION["login"]){
                $is_admins_login_found = true;
                break;
            }
        }
        if(!$is_admins_login_found){
            unset($_SESSION["login"]);
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../index.php");
        }
    }
    $_SESSION["errors"] = [
        "login"     =>      "",
        "password"  =>      "",
        "avatar"    =>      ""
    ];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $login = $_POST["login"];
    $login_error = "";
    $password = $_POST["password"];
    $password_error = "";
    $co_password = $_POST["co-password"];
    $_SESSION["bad"] = [
        "login" => $login,
        "firstname" => $firstname,
        "lastname" => $lastname
    ];
    $has_errors = false;
    $authorized_extensions = [
        ".png",
        ".jpeg",
        ".jpg"
    ];
    $avatar_error = "";
    $extension = strrchr($_FILES["avatar"]["name"],".");
    if(!empty($firstname) AND !empty($lastname) 
        AND !empty($login) AND !empty($password) 
        AND !empty($co_password) AND !empty($_FILES))
    {
        if($password === $co_password){
            $firstname = strip_tags($firstname);
            $lastname = strip_tags($lastname);
            $login = strip_tags($login);
            $is_this_user_exist = false;
            foreach ($data as $key => $value) {
                foreach ($value as  $elts) {
                    if($elts["login"] === $login){
                        $is_this_user_exist = true;
                        break;
                    }
                }
                if($is_this_user_exist){
                    break;
                }
            }
            if(!$is_this_user_exist){
                if(in_array($extension,$authorized_extensions)){
                    $avatar = "../uploads/".$login."".$extension;
                    if(!$is_this_user_exist AND !isset($_SESSION["login"])){
                        $data['users'][] = [
                            "firstname" => $firstname,
                            "lastname" => $lastname,
                            "login" => $login,
                            "password" => $password,
                            "avatar" => $avatar,
                            "score" => 0,
                            "goodAnswers" => array()
                        ];
                        if(move_uploaded_file($_FILES["avatar"]["tmp_name"],$avatar)){
                            add_contents($data,"../js/database.json");
                        }else {
                            $avatar_error = "Erreur lors du chargement de l'image";
                            $has_errors = true;
                        }
                        
                    }
                    else if(!$is_this_user_exist AND isset($_SESSION["login"])){
                        $data["admins"][] = [
                            "firstname" => $firstname,
                            "lastname" => $lastname,
                            "login" => $login,
                            "password" => $password,
                            "avatar" => $avatar
                        ];
                        if(move_uploaded_file($_FILES["avatar"]["tmp_name"],$avatar)){
                            add_contents($data,"../js/database.json");
                        }else {
                            $avatar_error = "Erreur lors du chargement de l'image";
                            $has_errors = true;
                        }
                    }
                }else {
                    $avatar_error = "Veuillez charger une images de type PNG, JPEG ou JPG";
                    $has_errors = true;
                }
            }else{
                $login_error = "Ce login est deja utilise. Veuillez choisir un autre login.";
                $has_errors = true;
            }
        }else{
            $password_error = "Les mots de passe ne correspondent pas :(";
            $has_errors = true;
        }
    }
    if($has_errors AND !$is_admins_login_found){
        $_SESSION["errors"]["login"] = $login_error;
        $_SESSION["errors"]["password"] = $password_error;
        $_SESSION["errors"]["avatar"] = $avatar_error;
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../views/create-compte.php");
    }elseif ($has_errors AND isset($_SESSION["login"])) {
        $_SESSION["errors"]["login"] = $login_error;
        $_SESSION["errors"]["password"] = $password_error;
        $_SESSION["errors"]["avatar"] = $avatar_error;
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../views/settings.php?page=create-admin#create");
    }
    else if(!$has_errors AND !isset($_SESSION["login"])){
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../index.php");
    }
    else if(!$has_errors AND isset($_SESSION["login"])){
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../views/settings.php?page=create-admin#create");
    }
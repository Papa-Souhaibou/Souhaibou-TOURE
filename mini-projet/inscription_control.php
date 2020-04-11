<?php
    session_start();
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $co_password = $_POST["co-password"];
    $authorized_extensions = [
        ".png",
        ".jpeg",
        ".jpg"
    ];
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
            include_once("database.php");
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
            if(in_array($extension,$authorized_extensions)){
                $avatar = "uploads/".$login."".$extension;
            }
            if(!$is_this_user_exist AND !isset($_SESSION["login"])){
                move_uploaded_file($_FILES["avatar"]["tmp_name"],$avatar);
                $data['users'][] = [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "login" => $login,
                    "password" => $password,
                    "avatar" => $avatar
                ];
                $data = json_encode($data);
                file_put_contents($databaseURL,$data);
            }
            else if(!$is_this_user_exist AND isset($_SESSION["login"])){
                $data['admins'][] = [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "login" => $login,
                    "password" => $password,
                    "avatar" => $avatar
                ];
                $data = json_encode($data);
                file_put_contents($databaseURL,$data);
            }
        }
    }

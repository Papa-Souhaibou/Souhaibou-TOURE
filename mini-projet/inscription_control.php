<?php
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $co_password = $_POST["co-password"];
    $avatar = $_POST["avatar"];
    if(!empty($firstname) AND !empty($lastname) 
        AND !empty($login) AND !empty($password) 
        AND !empty($co_password) AND !empty($avatar))
    {
        if($password === $co_password){
            $firstname = strip_tags($firstname);
            $lastname = strip_tags($lastname);
            $login = strip_tags($login);
            $password = password_hash($password,PASSWORD_DEFAULT);
            $is_this_user_exist = false;
            include_once("database.php");
            foreach ($data as $key => $value) {
                foreach ($value as  $elts) {
                    if($elts["login"] === $login){
                        $is_this_user_exist = true;
                        return;
                    }
                }
            }
            if(!$is_this_user_exist AND !isset($_SESSION["login"])){
                $data['users'][] = [
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "login" => $login,
                    "password" => $password,
                    "avatar" => "avatar"
                ];
                $data = json_encode($data);
                file_put_contents($databaseURL,$data);
            }
        }
    }

<?php
    session_start();
    function get_connexion(array $data,$login,$password,$status,string $location){
        foreach ($data[$status] as $user) {
            if($user["login"] === $login){
                if($user["password"] === $password){
                    $_SESSION["login"] = $user["login"];
                    $_SESSION["firstname"] = $user["firstname"];
                    $_SESSION["lastname"] = $user["lastname"];
                    $_SESSION["avatar"] = $user["avatar"];
                    if($status === "users"){
                        $_SESSION["score"] = $user["score"];
                    }
                    return $location;
                }else {
                    return "password-error";
                }
            }
        }
        return "not-exist";
    }
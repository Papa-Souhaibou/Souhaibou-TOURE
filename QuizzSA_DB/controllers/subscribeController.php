<?php
    session_start();
    include_once("../models/databaseAccess.php");
    if(isset($_POST["submit"])){
        $login = htmlspecialchars($_POST["login"]);
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        $password = $_POST["password"];
        $coPassword = $_POST["co-password"];
        $_SESSION["login"] = $login;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["password"] = $password;
        $_SESSION["coPassword"] = $coPassword;
        $avatar = $_FILES["avatar"];
        $avatarName = "";
        $authorized_extensions = [
            ".png",
            ".jpeg",
            ".jpg"
        ];
        $hasError = false;
        $player = [
            "nomJoueur" => "",
            "prenomJoueur" => "",
            "loginJoueur" => "",
            "avatarJoueur" => "",
            "passwordJoueur" => "",
            "scoreJoueur" => 0,
            "statusJoueur" => "actif"
        ];
        if(empty($login)){
            $hasError = true;
            $_SESSION["loginErrors"] = "Ce champs est obligatoire";
        }
        if(empty($firstname)){
            $hasError = true;
            $_SESSION["firstnameErrors"] = "Ce champs est obligatoire";
        }else {
            $player["prenomJoueur"] = $firstname;
        }
        if(empty($lastname)){
            $hasError = true;
            $_SESSION["lastnameErrors"] = "Ce champs est obligatoire";
        }else {
            $player["nomJoueur"] = $lastname;
        }
        if(empty($password)){
            $hasError = true;
            $_SESSION["passwordErrors"] = "Ce champs est obligatoire";
        }
        if(empty($coPassword)){
            $hasError = true;
            $_SESSION["coPasswordErrors"] = "Ce champs est obligatoire";
        }
        if(empty($avatar)){
            $hasError = true;
            $_SESSION["avatarErrors"] = "Ce champs est obligatoire";
        }else{
            $extension = strrchr($_FILES["avatar"]["name"],".");
            if(in_array($extension,$authorized_extensions)){
                $avatarName = "../uploads/".$login."".$extension;
                if(move_uploaded_file($avatar["tmp_name"],$avatarName)){
                    $player["avatarJoueur"] = $avatarName;
                }else{
                    $hasError = true;
                    $_SESSION["avatarErrors"] = "Erreur lors du chargement de l'avatar.";
                }
            }else{
                $hasError = true;
                $_SESSION["avatarErrors"] = "Veuillez uploader une image.";
            }
        }
        if(!empty($login)){
            $admin = $adminManager->getAdmin($login);
            $player = $playerManager->getPlayer($login);
            if($admin || $player){
                $hasError = true;
                $_SESSION["loginErrors"] = "Ce compte existe deja.";
            }else{
                $player["loginJoueur"] = $login;
            }
        }

        if(!empty($password) && !empty($coPassword)){
            if($password !== $coPassword){
                $hasError = true;
                $_SESSION["coPasswordErrors"] = "Les deux password ne correspondent pas.";
            }else{
                $password = password_hash($password,PASSWORD_DEFAULT);
                $player["passwordJoueur"] = $password; 
            }
        }
        if($hasError){
            header("Location:../index.php");
        }else{
            $player = [
                "nomJoueur" => $lastname,
                "prenomJoueur" => $firstname,
                "loginJoueur" => $login,
                "avatarJoueur" => $avatarName,
                "passwordJoueur" => $password,
                "scoreJoueur" => 0,
                "statusJoueur" => "actif"
            ];
            $player = new Player($player);
            $playerManager->add($player);
        }
    }

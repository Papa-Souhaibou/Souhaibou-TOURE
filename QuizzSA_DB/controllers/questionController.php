<?php
    session_start();
    require_once("../models/databaseAccess.php");
    if(isset($_POST["submit"])){
        function getChoice(String $type,array $choice){
            $choix = $_POST[$type];
            $choixPossible = "";
            for ($i=0; $i < count($choix); $i++) {
                if($i === count($choix) - 1)
                    $choixPossible .= htmlspecialchars($choix[$i]);
                else
                    $choixPossible .= htmlspecialchars($choix[$i]).",";
            }
            return $choixPossible;
        }
        function getResponse(String $type,array $choices,$selected){
            if($type === "radio"){
                $index = (int)$selected;
                return htmlspecialchars($choices[$index]);
            }else{
                $response = "";
                $arraySize = count($selected);
                for ($i=0; $i < $arraySize; $i++) {
                    $index = (int)$selected[$i];
                    if($i === $arraySize -1)
                        $response .= htmlspecialchars($choices[$index]);
                    else
                        $response .= htmlspecialchars($choices[$index]).",";
                }
                return $response;
            }
        }
        $ennonce = htmlspecialchars($_POST["ennonce"]);
        $note = (int) htmlspecialchars($_POST["note"]);
        $type = htmlspecialchars($_POST["type"]);
        $choixPossible = "";
        $response = "";
        $hasError = false;
        $admin = $adminManager->getAdmin($_SESSION["userLogin"]);
        if(empty($ennonce)){
            $hasError = true;
            $_SESSION["ennonceError"] = "Ce champs est obligatoire.";
        }
        if(empty($note)){
            $hasError = true;
            $_SESSION["noteError"] = "Ce champs est obligatoire.";
        }
        if(empty($type)){
            $hasError = true;
            $_SESSION["typeError"] = "Veuillez choisir un type de reponse.";
        }

        if($type === "checkbox"){
            if(empty($_POST["checkbox"])){
                $hasError = true;
                $_SESSION["checkboxError"] = "Ce champs est obligatoire.";
            }else {
                $choix = $_POST["checkbox"];
                $choixPossible = getChoice("checkbox",$choix);
                if(empty($_POST["slected"]) || count($_POST["slected"]) < 2){
                    $hasError = true;
                    $_SESSION["checkboxError"] = "Veuillez choisir au moins 2 reponses.";
                }else {
                    $response = getResponse("checkbox",$choix,$_POST["slected"]);
                }
            }
        }else if($type === "radio"){
            if(empty($_POST["radio"])){
                $hasError = true;
                $_SESSION["radioError"] = "Ce champs est obligatoire.";
            }else{
                $choix = $_POST["radio"];
                $choixPossible = getChoice("radio",$choix);
                if(empty($_POST["slected"])){
                    $hasError = true;
                    $_SESSION["radioError"] = "Veuillez choisir une reponse.";
                }else{
                    $response = getResponse("radio",$choix,$_POST["slected"]);
                }
            }
        }else if($type === "text"){
            if(empty($text)){
                $hasError = true;
                $_SESSION["textError"] = "Ce champs est obligatoire.";
            }else{
                $choixPossible = htmlspecialchars($_POST["text"]);
                $response = $choixPossible;
            }
        }
        if(!$hasError){
            $question = new Question([
                "ennonceQuestion" => $ennonce,
                "typeQuestion" => $type,
                "choixPossible" => $choixPossible,
                "reponse" => $response,
                "note" => $note,
                "idAdmin" => $admin->getIdAdmin()
            ]);
            $questionManager->add($question);
            header("Location:../views/adminInterface.php");
        }else{
            header("Location:../views/adminInterface.php");
        }
    }
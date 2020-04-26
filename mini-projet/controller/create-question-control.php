<?php
    session_start();
    include_once("../models/questions.php");
    $hasError = false;
    $_SESSION["error-question"] = [
        "enonce" => "",
        "point"  => "",
        "choix"  => ""
    ];
    if(!isset($_POST["enonce"])){
        $_SESSION["error-question"]["ennonce"] = "Ce champ est obligatoire";
        $hasError = true;
    }
    if(!isset($_POST["point"])){
        $_SESSION["error-question"]["point"] = "Ce champ est obligatoire";
        $hasError = true;
    }
    if((int)$_POST["point"] < 1){
        $_SESSION["error-question"]["ennonce"] = "Le nombre de point doit etre superieur a 0";
        $hasError = true;
    }
    if($_POST["choix"] === "#"){
        $_SESSION["error-question"]["choix"] = "Ce champ est obligatoire";
        $hasError = true;
    }
    if($hasError){
        header('Status: 301 Moved Permanently', false, 301);
        header("Location:../views/settings.php#create-question");
    }
    else{
        $questions = get_question_list();
        $saved = false;
        $choixMultiple = [];
        $enonce = ($_POST["enonce"]);
        $point = (int) $_POST["point"];
        $type = $_POST["choix"];
        foreach($_POST["response"] as $value){
            $choixMultiple[] = ($value);
        }
        if($type === "radio"){
            $indexOfResponse = (int) $_POST["reponses"];
            $reponse = $_POST["response"][$indexOfResponse];
            $questions[] = [
                "enonce"    => $enonce,
                "typeReponse"   => $type,
                "choix"     => $choixMultiple,
                "reponse"   => $reponse,
                "note"  =>  $point
            ];
            put_questions($questions);
            $saved = true;
        }
        else if($type === "checkbox"){
            $reponse = [];
            foreach ($_POST["reponseCheckbox"] as $value) {
                $index = (int) $value;
                $exact = $_POST["response"][$index];
                $reponse[] = $exact;
            }
            $questions[] = [
                "enonce"    => $enonce,
                "typeReponse"   => $type,
                "choix"     => $choixMultiple,
                "reponse"   => $reponse,
                "note"  =>  $point
            ];
            put_questions($questions);
            $saved = true;
        }
        else if($type === "text"){
            $reponse = ($_POST["response"][0]);
            $questions[] = [
                "enonce"    => $enonce,
                "typeReponse"   => $type,
                "choix"     => $choixMultiple,
                "reponse"   => $reponse,
                "note"  =>  $point
            ];
            put_questions($questions);
            $saved = true;
        }
        if($saved){
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../views/settings.php#create-question");
        }
    }
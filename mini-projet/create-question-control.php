<?php
    session_start();
    include_once("questions.php");
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
        header("Location:settings.php#create-question");
    }
    else{
        var_dump($_POST);
        $questions = get_question_list();
        $choixMultiple = [];
        $enonce = strip_tags($_POST["enonce"]);
        $point = (int) $_POST["point"];
        $type = $_POST["choix"];
        foreach($_POST["response"] as $value){
            $choixMultiple[] = strip_tags($value);
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
        }
        else if($type === "checkbox"){
            $reponse = [];
            foreach ($_POST["reponseCheckbox"] as $value) {
                $index = (int) $value;
                $exact = $_POST["response"][$index];
                $reponse[] = $exact;
            }
            
        }
        else if($type === "text"){
            $reponse = strip_tags($_POST["response"][0]);
            $questions[] = [
                "enonce"    => $enonce,
                "typeReponse"   => $type,
                "choix"     => $choixMultiple,
                "reponse"   => $reponse,
                "note"  =>  $point
            ];
            put_questions($questions);
        }
    }
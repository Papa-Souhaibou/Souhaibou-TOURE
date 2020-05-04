<?php
    session_start();
    if(!empty($_POST["number"])){
        include_once("../models/questions.php");
        $questions = get_our_contents_file();
        $question_number = count($questions);
        $number = (int) $_POST["number"];
        if($number < 5){
            $_SESSION["number-error"] = "Le nombre de questions par jeu doit etre superieur ou egal a 5";
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../views/settings.php#liste-question");
        }elseif ($number > $question_number) {
            $_SESSION["number-error"] = "Il existe $question_number questions et vous souhaitez $number questions par jeu.";
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../views/settings.php#liste-question");
        }
        else {
            $data = get_our_contents_file("../js/database.json");
            $data["number"] = $number;
            add_contents($data,"../js/database.json");
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../views/settings.php#liste-question");
        }
    }else {
            $_SESSION["number-error"] = "Ce champs est obligatoire";
            header('Status: 301 Moved Permanently', false, 301);
            header("Location:../views/settings.php#liste-question");
    }
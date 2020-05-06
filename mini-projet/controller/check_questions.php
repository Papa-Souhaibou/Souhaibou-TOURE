<?php
    session_start();
    include_once("../models/questions.php");
    $questions = get_our_contents_file();
    $users = get_our_contents_file("../js/database.json");
    $number_of_question = $users["number"];
    $login = $_SESSION["login"];
    $this_user = get_this_user($users["users"],$login);
    $page = (int) $_GET["question"] + 1;
    $enonce = $_POST["hidden"];
    $this_question = get_question($questions,$enonce);
    $reponses = null;
    $_SESSION["finished"] = false;
    if($this_question["typeReponse"] === "checkbox"){
        if(!empty($_POST["checkbox"])){
            $reponses = $this_question["reponse"];
            $number_of_responses = count($reponses);
            $counter = 0;
            $is_my_answers_correct = true;
            $_SESSION["checkbox"][$page-1] = [];
            foreach ($_POST["checkbox"] as $value) {
                if(!in_array($value,$reponses)){
                    $is_my_answers_correct = false;
                }else{
                    $counter++;
                }
                $_SESSION["checkbox"][$page-1][] = $value;
            }
            if($is_my_answers_correct AND $counter === $number_of_responses){
                if(isset($_SESSION["badAnswers"])){
                    $get_key = array_search($enonce,$_SESSION["badAnswers"]);
                    unset($_SESSION["badAnswers"][$get_key]);
                }
                if(isset($_SESSION["goodAnswers"])){
                    if(!in_array($enonce,$_SESSION["goodAnswers"]))
                        array_push($_SESSION["goodAnswers"],$enonce);
                }else {
                    $_SESSION["goodAnswers"][] = $enonce;
                }
            }
            else{
                $wrong = array_search($enonce,$this_user["goodAnswers"]);
                unset($this_user["goodAnswers"][$wrong]);
                if(!in_array($enonce,$_SESSION["badAnswers"]))
                    $_SESSION["badAnswers"][] = $enonce;
            }
        }
        elseif(empty($_POST["checkbox"])){
            $_SESSION["checkbox"][$page-1] = [];
            $wrong = array_search($enonce,$this_user["goodAnswers"]);
            unset($this_user["goodAnswers"][$wrong]);
            if(isset($_SESSION["badAnswers"])){
                if(!in_array($enonce,$_SESSION["badAnswers"]))
                    $_SESSION["badAnswers"][] = $enonce;
            }
            else
                $_SESSION["badAnswers"][] = $enonce;
        }
    }elseif ($this_question["typeReponse"] === "radio") {
        if(!empty($_POST["radio"])){
            $radio = $_POST["radio"];
            $reponses = $this_question["reponse"];
            $is_my_answers_correct = true;
            if($reponses != $radio){
                $is_my_answers_correct = false;
                $wrong = array_search($enonce,$this_user["goodAnswers"]);
                unset($this_user["goodAnswers"][$wrong]);
                if(isset($_SESSION["badAnswers"])){
                    if(!in_array($enonce,$_SESSION["badAnswers"]))
                        $_SESSION["badAnswers"][] = $enonce;
                }else
                    $_SESSION["badAnswers"][] = $enonce;
            }
            if($is_my_answers_correct){
                if(isset($_SESSION["badAnswers"])){
                    $get_key = array_search($enonce,$_SESSION["badAnswers"]);
                    unset($_SESSION["badAnswers"][$get_key]);
                }
                if(isset($_SESSION["goodAnswers"])){
                    if(!in_array($enonce,$_SESSION["goodAnswers"]))
                        array_push($_SESSION["goodAnswers"],$enonce);
                }else {
                    $_SESSION["goodAnswers"][] = $enonce;
                }
            }
            $_SESSION["radio"][$page-1] = $radio;
        }elseif(empty($_POST["radio"])){
            $wrong = array_search($enonce,$this_user["goodAnswers"]);
            unset($this_user["goodAnswers"][$wrong]);
            if(isset($_SESSION["badAnswers"])){
                if(!in_array($enonce,$_SESSION["badAnswers"]))
                    $_SESSION["badAnswers"][] = $enonce;
            }else
                $_SESSION["badAnswers"][] = $enonce;
        }
    }elseif ($this_question["typeReponse"] === "text") {
        if(!empty($_POST["text"])){
            $text = strtolower(trim($_POST["text"]));
            $reponses = strtolower(trim($this_question["reponse"]));
            if($reponses !== $text){
                if(isset($this_user["goodAnswers"])){
                    $get_key = array_search($enonce,$this_user["goodAnswers"]);
                    unset($_SESSION["goodAnswers"][$get_key]);
                }
                if(!in_array($enonce,$_SESSION["badAnswers"]))
                    $_SESSION["badAnswers"][] = $enonce;
            }
            else{
                if(isset($_SESSION["badAnswers"])){
                    $get_key = array_search($enonce,$_SESSION["badAnswers"]);
                    unset($_SESSION["badAnswers"][$get_key]);
                }
                if(isset($_SESSION["goodAnswers"])){
                    if(!in_array($enonce,$_SESSION["goodAnswers"]))
                        array_push($_SESSION["goodAnswers"],$enonce);
                }else {
                    $_SESSION["goodAnswers"][] = $enonce;
                }
            }
            $_SESSION["text"][$page-1] = $text;
        }else {
            $wrong = array_search($enonce,$this_user["goodAnswers"]);
            unset($this_user["goodAnswers"][$wrong]);
            if(isset($_SESSION["badAnswers"])){
                if(!in_array($enonce,$_SESSION["badAnswers"]))
                    $_SESSION["badAnswers"][] = $enonce;
            }else
                $_SESSION["badAnswers"][] = $enonce;
        }
    }
    if(isset($_POST["finished"]) || isset($_POST["quit"])){
        $users["number"] = $number_of_question;
        $nbr_user = count($users["users"]);
        $_SESSION["total"] = 0;
        $_SESSION["score"] = 0;
        $this_user_index = 0;
        for ($i=0; $i < $nbr_user; $i++) { 
            if($users["users"][$i]["login"] === $login){
                $this_user_index = $i;
                if(isset($_SESSION["goodAnswers"])){
                    foreach ($_SESSION["goodAnswers"] as $goodAnswer) {
                        if(!in_array($goodAnswer,$users["users"][$i]["goodAnswers"]))
                            $users["users"][$i]["goodAnswers"][] = $goodAnswer;
                        $question = get_question_by_enonce($questions,$goodAnswer);
                        $_SESSION["score"] += $question["note"];
                    }
                    foreach ($_SESSION["badAnswers"] as $badAnswer) {
                        $question = get_question_by_enonce($questions,$badAnswer);
                        $_SESSION["total"] += $question["note"];
                    }
                    break;
                }
            }
        }
        if($users["users"][$this_user_index]["score"] < $_SESSION["score"]){
            $users["users"][$this_user_index]["score"] = $_SESSION["score"];
        }
        $_SESSION["total"] += $_SESSION["score"];
        unset($_SESSION["checkbox"]);
        unset($_SESSION["radio"]);
        unset($_SESSION["text"]);
        unset($_SESSION["previous"]);
        $_SESSION["finished"] = true;
        add_contents($users,"../js/database.json");
    }
    header('Status: 301 Moved Permanently', false, 301);
    header("Location:../views/user-interface.php?question=$page");
<?php
    session_start();
    
    if(isset($_POST["indexQuestion"])){
        $indexQuestion = (int)$_POST["indexQuestion"];
        $typeQuestion = $_POST["typeQuestion"];
        $idQuestion = (int) $_POST["idQuestion"];
        if(isset($_POST["previous"]) && !empty($_SESSION["userResponse"][$indexQuestion])){
            echo json_encode($_SESSION["userResponse"][$indexQuestion]);
        }else{
            $_SESSION["userResponse"][$indexQuestion] = [
                "idQuestion" => $idQuestion,
                "reponse" => ""
            ];
            if(isset($_POST["next"]) || isset($_POST["previous"])){
                if($typeQuestion == "text"){
                    $_SESSION["userResponse"][$indexQuestion]["reponse"] = htmlspecialchars($_POST["text"]);
                }elseif ($typeQuestion == "radio") {
                    if(isset($_POST["radio"]))
                        $_SESSION["userResponse"][$indexQuestion]["reponse"] = $_POST["radio"];
                }elseif ($typeQuestion == "checkbox") {
                    if(isset($_POST["checkbox"])){
                        $size = count($_POST["checkbox"]);
                        $_SESSION["userResponse"][$indexQuestion]["reponse"] = [];
                        for ($i=0; $i < $size; $i++) { 
                            $_SESSION["userResponse"][$indexQuestion]["reponse"][] = $_POST["checkbox"][$i];
                        }
                    }
                }
                echo json_encode($_SESSION["userResponse"][$indexQuestion]);
            }
        }
        // elseif (isset($_POST["previous"])) {
        //     echo json_encode($_SESSION["userResponse"][$indexQuestion]);
        // }
        // var_dump($_POST,$_SESSION);
    }
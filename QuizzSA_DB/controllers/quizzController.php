<?php
    if(isset($_POST["indexQuestion"])){
        $typeQuestion = $_POST["typeQuestion"];
        $indexQuestion = (int) $_POST["indexQuestion"];
        if($typeQuestion == "text" || $typeQuestion == "radio"){
            $value = "";
            if(isset($_POST["radio"]) || isset($_POST["text"])){
                if($typeQuestion == "text"){
                    $value = htmlspecialchars($_POST["text"]);
                }else{
                    $value = htmlspecialchars($_POST["radio"]);
                }
                $reponse = [
                    "index" => $indexQuestion,
                    "reponse" => $value
                ];
                echo json_encode($reponse);
            }else{
                $value = "";
                $reponse = [
                    "index" => $indexQuestion,
                    "reponse" => $value
                ];
                echo json_encode($reponse);
            }
        }else if($typeQuestion == "checkbox"){
            if(isset($_POST["checkbox"])){
                $value = [];
                $size = count($_POST["checkbox"]);
                for ($i=0; $i < $size; $i++) { 
                    $value[] = $_POST["checkbox"][$i];
                }
                $reponse = [
                    "index" => $indexQuestion,
                    "reponse" => $value
                ];
                echo json_encode($reponse);
            }else{
                $value = "";
                $reponse = [
                    "index" => $indexQuestion,
                    "reponse" => $value
                ];
                echo json_encode($reponse);
            }
        }
    }
<?php
    include_once("./../models/databaseAccess.php");
    $tab = [
        "idQuestion" => 25,
        "ennonceQuestion" => "Comment tu vas ?",
        "typeQuestion" => "text",
        "choixPossible" => "bien",
        "reponse" => "bien",
        "note" => 15,
        "idAdmin" => 1
    ];
    $question = new Question($tab);
    $questionManager->setQuestion($question,3);
    var_dump(json_encode($question));
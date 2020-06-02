<?php
    include_once("./../models/databaseAccess.php");
    $tab = [
        "idQuestion" => 25,
        "ennonceQuestion" => "Comment tu vas ?",
        "typeQuestion" => "text",
        "choixPossible" => "bien,mal",
        "reponse" => "bien",
        "note" => 15,
        "idAdmin" => 3
    ];
    $question = new Question($tab);
    var_dump(json_encode($question));
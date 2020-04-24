<?php
    $databaseURL = "js/questions.json";
    function get_question_list(){
        global $databaseURL;
        $database = file_get_contents($databaseURL);
        $question = json_decode($database,true);
        return $question;
    }
    function put_questions(array $question){
        global $databaseURL;
        $question = json_encode($question);
        file_put_contents($databaseURL,$question);
    }
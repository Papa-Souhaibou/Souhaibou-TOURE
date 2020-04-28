<?php
    function get_our_contents_file($url="../js/questions.json"){
        $database = file_get_contents($url);
        $question = json_decode($database,true);
        return $question;
    }
    function add_contents(array $question,$url="../js/questions.json"){
        $question = json_encode($question);
        file_put_contents($url,$question);
    }
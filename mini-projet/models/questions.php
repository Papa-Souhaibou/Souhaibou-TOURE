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
    function get_question ($questions,$enonce){
        foreach ($questions as $value) {
            if($value["enonce"] === $enonce){
                return $value;
            }
        }
        return null;
    }
    function get_this_user($users,$login){
        foreach ($users as $user) {
            if($user["login"] === $login){
                return $user;
            }
        }
        return null;
    }
    function set_this_user($users,$new_user,$url="../js/database.json",$status="users"){
        $user = get_this_user($users[$status],$new_user["login"]);
        $index_of_user = array_search($user,$users[$status]);
        $users[$status][$index_of_user] = $new_user;
        add_contents($users,$url);
    }
    function get_question_by_enonce(array $questions,string $enonce){
        foreach ($questions as $key => $question) {
            if($question["enonce"] === $enonce){
                return $question;
            }
        }
        return null;
    }
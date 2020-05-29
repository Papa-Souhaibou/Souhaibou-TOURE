<?php
    $username = "root";
    $password = "";
    $dbname = "quizzsa";
    $db = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8",$username,$password);
    
    function getUsers(){
        global $db;
        $response = $db->query("SELECT * FROM joueurs");
        $players = $response->fetchAll();
        $users = [];
        foreach ($players as $cle => $player) {
            foreach ($player as $key => $value) {
                if(strlen($key) >= 8){
                    if($key === 'idjoueur'){
                        $users[$cle][$key] = (int)$value;
                    }else {
                        $users[$cle][$key] = $value;
                    }
                }
            }
        }
        return $users;
    }
    function getAdmins(){

    }
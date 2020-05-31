<?php
    // $username = "207722";
    $username = "root";
    // $password = "P@sser20";
    $password = "";
    // $dbname = "odcquizzsa_quizzsa";
    $dbname = "quizzsa";
    // $host = "mysql-odcquizzsa.alwaysdata.net";
    $host = "localhost";
    require_once("../models/Autoloader.class.php");
    Autoloader::register();
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
    $playerManager = new PlayerManager($db);
    $adminManager = new AdminManager($db);
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
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
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die("Erreur lors de la connexion a la base de donnees");
    }
    global $db;
    $playerManager = new PlayerManager($db);
    $adminManager = new AdminManager($db);
    $questionManager = new QuestionManager($db);
    
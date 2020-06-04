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
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $playerManager = new PlayerManager($db);
    $adminManager = new AdminManager($db);
    $questionManager = new QuestionManager($db);
    
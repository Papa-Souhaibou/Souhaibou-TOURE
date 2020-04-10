<?php
    $databaseURL = "js/database.json";
    $database = file_get_contents($databaseURL);
    $data = json_decode($database,true);
<?php
    include_once("../models/databaseAccess.php");
    $response = $db->query("SELECT COUNT(*) number FROM joueurs");
    $number = $response->fetch(PDO::FETCH_ASSOC);
    echo json_encode($number);
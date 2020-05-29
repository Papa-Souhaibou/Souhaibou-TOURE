<?php
    include_once("../models/databaseAccess.php");
    $users = getUsers();
    $users = json_encode($users,true);
    echo $users;
?>
<?php
    include_once("./databaseAccess.php");
    if(isset($_POST["list"])){
        $questions = $questionManager->getListQuestion();
        $questions = json_encode($questions);
        echo $questions;
    }else if(isset($_POST["delete"])){
        $id = (int)$_POST["delete"];
        $questionManager->delete($id);
    }
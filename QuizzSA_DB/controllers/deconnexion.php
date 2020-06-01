<?php
    if(isset($_POST["submit"])){
        unset($_SESSION["userLogin"]);
        header("Location:../index.php");
    }
<?php
    include("../models/questions.php");
    $data = get_our_contents_file("../js/database.json");
    $data = json_encode($data);
    echo $data;
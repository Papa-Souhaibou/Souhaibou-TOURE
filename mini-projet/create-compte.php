<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin-register.css">
    <style>
        #container {
            width: 80%;
            margin: auto;
            background-color: white;
            border-radius: 10px;
        }
        #create {
            width: 95%;
            margin: 10px auto;
            display: flex;
            justify-content: space-between;
        }
        #circle {
            width:50%;
            height: 190px;
            margin: 50px auto;
            border: 2px solid darkturquoise;
            border-radius: 50%;
        }
        .btn-register {
            width: 120px;
            margin-left: 100px;
            background-color: darkturquoise;
            height: 40px;
            color: white;
            font-size: 1em;
            border-radius: 10px;
            border: solid 1px darkturquoise;
            margin-bottom: 50px;
        }
    </style>
    <title>Creation Compte</title>
</head>
<body>
    <?php
        include("menu.php");
    ?>
    <div id="container">
        <?php
            include("inscription.php"); 
        ?>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
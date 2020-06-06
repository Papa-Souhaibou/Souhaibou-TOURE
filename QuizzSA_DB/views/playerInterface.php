<?php
  session_start();
  include_once("../models/databaseAccess.php");
  $player = $playerManager->getPlayer($_SESSION["userLogin"]);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
</head>
  <body>
    <?php
        include_once("./playerNavBar.php");
    ?>
    <div class="container-fluid" id="playerContainer">
        <div class="row mt-3">
          <div class="card text-left col-sm-8">
            <img class="card-img-top" src="" alt="">
            <div class="card-body">
              <h2 class="card-title text-center mb-sm-2">Question 1/10</h2>
              <div class="row justify-content-center mb-sm-2">
                <p class="text-center m-auto bg bg-secondary rounded-lg" id="enonce">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita, deserunt.</p>
              </div>
              <div class="row justify-content-between mt-4">
                <form action="" method="post" class="form col-10" id="form">
                  
                </form>
                <div class="justify-content-center">
                  <h3 class="bg bg-secondary rounded-lg" id="point">15pts</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="card text-left col-sm-4">
            <img class="card-img-top" src="" alt="">
            <div class="card-body">
              <h4 class="card-title">Title</h4>
              <p class="card-text">Body</p>
            </div>
          </div>
        </div>
    </div>
    <?php
        include_once("./footer.php");
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/player.js"></script>
  </body>
</html>
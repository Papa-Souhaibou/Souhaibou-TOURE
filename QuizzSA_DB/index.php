<?php
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php
      include("views/defaultNavBar.php");
    ?>
    <div class="container-fluid">
      <div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Se connecter</h1>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                <form action="./controllers/loginController.php" class="form" id="loginForm" method="post">
                  <div class="form-group">
                    <i class="fa fa-user-circle fa-lg fa-fw" aria-hidden="true"></i>
                    <input type="text" class="form-control" name="login" id="login">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["loginError"])){
                          echo $_SESSION["loginError"];
                          unset($_SESSION["loginError"]);
                          ?>
                      <script>
                        $(function () {
                          $("#connexion").click();
                        });
                      </script>
                      <?php
                        }
                      ?>
                    </small> 
                  </div>
                  <div class="form-group">
                    <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                    <input type="password" class="form-control" name="password" id="password">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["passwordError"])){
                          echo $_SESSION["passwordError"];
                          unset($_SESSION["passwordError"]);
                      ?>
                      <script>
                        $(function () {
                          $("#connexion").click();
                        });
                      </script>
                      <?php
                        }
                      ?>
                    </small> 
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn mainBg btn-lg" name="submit" id="loginSubmit">Se connecter</button>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="subscribe-modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title">Inscription</h1>
              <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
              <form action="./controllers/subscribeController.php" class="form" id="subscribeForm" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="inputLastname">Nom</label>
                    <input type="text" class="form-control" id="inputLastname" name="lastname" placeholder="Nom" value="<?= @$_SESSION["lastname"] ?>">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["lastnameErrors"])){
                          echo $_SESSION["lastnameErrors"];
                          unset($_SESSION["lastnameErrors"]);
                        ?>
                      <script>
                        $(function () {
                          $("#subcribtion").click();
                        });
                      </script>
                      <?php
                        }
                        unset($_SESSION["lastname"]);
                      ?>
                    </small>
                  </div>
                  <div class="col-sm-4 d-none d-md-block d-lg-block">
                    <div class="ml-4 showAvatar" id="showAvatar">

                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="inputfirstname">Prenom</label>
                    <input type="text" class="form-control" name="firstname" id="inputfirstname" placeholder="Prenom" value="<?= @$_SESSION["firstname"] ?>">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["firstnameErrors"])){
                          echo $_SESSION["firstnameErrors"];
                          unset($_SESSION["firstnameErrors"]);
                        ?>
                      <script>
                        $(function () {
                          $("#subcribtion").click();
                        });
                      </script>
                      <?php
                        }
                        unset($_SESSION["firstname"]);
                      ?>
                    </small>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="inputLogin">Login</label>
                    <input type="text" class="form-control" name="login" id="inputLogin" placeholder="Login" value="<?= @$_SESSION["login"] ?>">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["loginErrors"])){
                          echo $_SESSION["loginErrors"];
                          unset($_SESSION["loginErrors"]);
                        ?>
                      <script>
                        $(function () {
                          $("#subcribtion").click();
                        });
                      </script>
                      <?php
                        }
                        unset($_SESSION["login"]);
                      ?>
                    </small>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password" value="<?= @$_SESSION["password"] ?>">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["passwordErrors"])){
                          echo $_SESSION["passwordErrors"];
                          unset($_SESSION["passwordErrors"]);
                        ?>
                      <script>
                        $(function () {
                          $("#subcribtion").click();
                        });
                      </script>
                      <?php
                        }
                        unset($_SESSION["password"]);
                      ?>
                    </small>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="inputConfirmPassword">Confirm Your Password</label>
                    <input type="password" class="form-control" name="co-password" id="inputConfirmPassword" placeholder="Confirm Your Password" value="<?= @$_SESSION["coPassword"] ?>">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["coPasswordErrors"])){
                          echo $_SESSION["coPasswordErrors"];
                          unset($_SESSION["coPasswordErrors"]);
                        ?>
                      <script>
                        $(function () {
                          $("#subcribtion").click();
                        });
                      </script>
                      <?php
                        }
                        unset($_SESSION["coPassword"]);
                      ?>
                    </small>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="inputAvatar">Avatar</label>
                    <input type="file" name="avatar" class="form-control" id="inputAvatar">
                    <small class="text-danger">
                      <?php
                        if(isset($_SESSION["avatarErrors"])){
                          echo $_SESSION["avatarErrors"];
                          unset($_SESSION["avatarErrors"]);
                        ?>
                      <script>
                        $(function () {
                          $("#subcribtion").click();
                        });
                      </script>
                      <?php
                        }
                      ?>
                    </small>
                  </div>
                </div>
                <div class="text-center col-sm-8">
                  <button type="submit" class="btn mainBg btn-lg" name="submit" id="subscribtionSubmit">S'inscrire</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
      <h1 class="text-center mt-3">Bienvenue sur la page QuizzSA</h1>
        <div class="row bgImg rounded">
            <div class="col-4 mt-5 ml-3">
              <p>
                Cette plateforme a pour but de vous aider a ameliorer votre niveau de culture generale.
              </p>
            </div>
        </div>
    </div>
    <?php
      include("views/footer.php");
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
  </body>
</html>
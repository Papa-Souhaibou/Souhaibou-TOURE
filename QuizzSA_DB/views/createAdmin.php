<div class="col-11 ml-auto mr-auto mt-3 mb-3" id="_createAdmin">
    <div class="card rounded-lg">
      <div class="card-body">
        <h3 class="card-title text-center">Inscription</h3>
        <form action="../controllers/subscribeController.php" class="form" id="subscribeForm" method="post" enctype="multipart/form-data">
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
                        if(isset($_SESSION["lastname"])){
                          unset($_SESSION["lastname"]);
                        }
                      ?>
                </small>
                </div>
                <div class="col-sm-4">
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
                        if(isset($_SESSION["firstname"])){
                          unset($_SESSION["firstname"]);
                        }
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
                        if(isset($_SESSION["login"])){
                          unset($_SESSION["login"]);
                        }
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
                        if(isset($_SESSION["password"])){
                          unset($_SESSION["password"]);
                        }
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
                        if(isset($_SESSION["coPassword"])){
                          unset($_SESSION["coPassword"]);
                        }
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
    </div>
</div>
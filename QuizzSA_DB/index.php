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
                <form action="" class="form" method="post">
                  <div class="form-group">
                    <i class="fa fa-user-circle fa-lg fa-fw" aria-hidden="true"></i>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                    <input type="password" class="form-control">
                  </div>
                  <div class="text-center">
                    <button type="button" class="btn mainBg btn-lg">Se connecter</button>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
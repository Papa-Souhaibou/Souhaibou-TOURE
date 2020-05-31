<nav class="navbar navbar-expand-lg navbar-dark mainBg" id="defaultNavbar">
  <a class="navbar-brand" href="#"><img src="../img/logo-QuizzSA.png" class="avatar" alt="logo"></a>
  <p>Someone Elese</p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link login" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a class="nav-link" href="#" >Tableau de bord</a></li>
      <li><a class="nav-link" href="#" >Creer Admin</a></li>
      <li><a class="nav-link" href="#" >Creer Questions</a></li>
      <li><a class="nav-link" href="#" >Liste Joueur</a></li>
      <li><a class="nav-link" href="#" >Liste Question</a></li>
      <li>
        <form action="./controllers/loginController.php" class="form" id="loginForm" method="post">
          <button type="submit" class="btn mainBg btn-lg" name="submit" id="loginSubmit">Deconnexion</button>
        </form>
      </li>
    </ul>
  </div>
</nav>
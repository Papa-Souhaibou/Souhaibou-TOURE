<nav class="navbar navbar-expand-lg navbar-dark mainBg" id="defaultNavbar">
  <a class="navbar-brand" href="#"><img src="<?= $admin->getAvatarAdmin() ?>" class="avatar" alt="logo"></a>
  <p><?= $admin->getPrenomAdmin()." ".$admin->getNomAdmin() ?></p>
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
    <ul class="nav navbar-nav navbar-right" id="navbarAdmin">
      <li><a class="nav-link" href="#dashboard" id="dashboard">Tableau de bord</a></li>
      <li><a class="nav-link" href="#createAdmin" id="createAdmin">Creer Admin</a></li>
      <li><a class="nav-link" href="#createQuestion" id="createQuestion">Creer Questions</a></li>
      <li><a class="nav-link" href="#listJoueur" id="listJoueur">Liste Joueur</a></li>
      <li><a class="nav-link" href="#listQuestion" id="listQuestion">Liste Question</a></li>
      <li>
        <form action="../controllers/deconnexion.php" class="form" id="loginForm" method="post">
          <button type="submit" class="btn mainBg btn-lg" name="submit" id="loginSubmit">Deconnexion</button>
        </form>
      </li>
    </ul>
  </div>
</nav>
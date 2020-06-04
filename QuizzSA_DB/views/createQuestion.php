<div class="row m-3" id="_createQuestion">
  <div class="col-sm-8">
    <div class="card rounded-lg">
      <div class="card-body">
        <h3 class="card-title text-center">Parametrer Vos Questions</h3>
        <form action="../controllers/questionController.php" id="questionForm" method="post">
            <div class="form-group row">
                <label for="text-area" class="col-sm-2 col-form-label">Question</label>
                <div class="col-sm-10">
                    <textarea class="form-control questionField" name="ennonce" id="text-area" rows="3"></textarea>
                    <small class="text-danger">
                    <?php
                      if(isset($_SESSION["ennonceError"])){
                        echo $_SESSION["ennonceError"];
                        unset($_SESSION["ennonceError"]);
                      }
                    ?>
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label for="point" class="col-sm-2 col-form-label">Nbre De Points</label>
                <div class="col-sm-10">
                    <input type="number" name="note" id="point" class="form-control questionField" placeholder="" aria-describedby="helpId">
                    <small class="text-danger">
                    <?php
                      if(isset($_SESSION["noteError"])){
                        echo $_SESSION["noteError"];
                        unset($_SESSION["noteError"]);
                      }
                    ?>
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Type De reponse</label>
                <div class="col-sm-9">
                    <select class="mdb-select md-form form-control questionField" name="type" id="type">
                        <option value="" disabled selected>Donnez le type de reponse</option>
                        <option value="checkbox">Choix Mulitiple</option>
                        <option value="radio">Choix Simple</option>
                        <option value="text">Type Text</option>
                    </select>
                    <small class="text-danger">
                    <?php
                      if(isset($_SESSION["typeError"])){
                        echo $_SESSION["typeError"];
                        unset($_SESSION["typeError"]);
                      }
                    ?>
                    </small>
                </div>
                <img src="../img/ic-ajout-reponse.png" class="add-response" alt="Icone ajouter reponse.">
            </div>
            <div id="response-container">
                
            </div>
            <button type="submit" class="btn float-right mainBg" name="submit">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card rounded-lg">
      <div class="card-body">
        <h6 class="card-title">Nombre De Question/Jeu</h6>
        <form action="../controllers/questionController.php" method="post" id="numForm">
            <div class="form-group">
                <label for=""></label>
                <input type="number" name="num" id="" class="form-control" placeholder="" aria-describedby="helpId">
                <small class="text-danger">
                <?php
                  if(isset($_SESSION["numError"])){
                    echo $_SESSION["numError"];
                    unset($_SESSION["numError"]);
                  }
                ?>
                </small>
            </div>
            <button type="submit" class="btn float-right mainBg" name="numSubmit">OK</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title">Parametrer Vos Questions</h1>
        <button type="button" class="close" data-dismiss="modal">x</button>
      </div>
      <div class="modal-body">
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
        <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- <div class="col-12" id="_listQuestion"> -->
  <!-- <div class="col-12 mt-3 mb-3"> -->
    <!-- <div class="card col-12 mt-3 mb-3 bg bg-secondary"> -->
      <div class="card-body col-12 container  bg bg-secondary nopadding mt-3 mb-3 rounded" id="listQuestionContainer">
        <h3 class="card-title text-center col-12">Liste Question</h3>
      </div>
    <!-- </div> -->
  <!-- </div> -->
<!-- </div> -->
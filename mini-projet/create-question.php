<div id="create-question">
    <h1>Parametrer vos questions</h1>
    <form action="create-question-control.php" method="post" id="question-form">
        <div class="question-container">
            <label for="enonce">Questions</label>
            <input type="text" error="error-enonce" name="enonce" id="enonce">
            <div class="error-question" id="error-enonce">
                <?php
                    if(isset($_SESSION["error-question"]["enonce"])){
                        echo $_SESSION["error-question"]["enonce"];
                        unset($_SESSION["error-question"]["enonce"]);
                    }
                ?>
            </div>
        </div>
        <div class="question-container">
            <label for="point">Nbre de Points</label>
            <input type="number" error="error-point" name="point" id="point">
            <div class="error-question" id="error-point">
                <?php
                    if(isset($_SESSION["error-question"]["point"])){
                        echo $_SESSION["error-question"]["point"];
                        unset($_SESSION["error-question"]["point"]);
                    }
                ?>
            </div>
        </div>
        <div class="question-container">
            <label for="choix">Type de reponse</label>
            <select name="choix" error="error-choix" id="choix">
                <option value="#">Donnez le type de reponse</option>
                <option value="checkbox">Choix Mulitiple</option>
                <option value="radio">Choix Simple</option>
                <option value="text">Type Text</option>
            </select>
            <img src="img/icones/ic-ajout-reponse.png" class="add-response" alt="Icone ajouter reponse.">
            <div class="error-question" id="error-choix">
                <?php
                    if(isset($_SESSION["error-question"]["choix"])){
                        echo $_SESSION["error-question"]["choix"];
                        unset($_SESSION["error-question"]["choix"]);
                    }
                ?>
            </div>
        </div>
        <div class="display-response"></div>
        <button type="submit" class="btn-submit-question" name="btn-submit-question">Enregistrer</button>
    </form>
</div>
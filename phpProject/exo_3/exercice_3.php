<?php
    session_start();
    include('includes/exo_3.inc.php');
?>
<div id="form1">
    <form action="#" method="post">
        <div>
            <label for="nbr">Combien de mots</label><br>
            <input type="text" class="input-field" name="nbr" id="nbr" value="<?= (isset($_SESSION["nbr"])?$_SESSION["nbr"]:'') ?>">
        </div>
        <button type="submit" class="btn blue" name="submit">Valider</button>
        <input type="reset" class="btn red" value="Annuler">
    </form>
</div>
<div id="form2">
    <form action="#" method="post">
        <?php
            if(isset($_POST["submit"])){
                $_SESSION["submit"] = $_POST["submit"];
                $nbr = (int)$_POST["nbr"];
                $_SESSION["nbr"] = $nbr;
            } 
            if($_SESSION["nbr"] > 0 OR isset($_POST["result"])){
                for ($i=0; $i < $_SESSION["nbr"]; $i++) { 
                ?>
                    <label for="<?=($i+1) ?>">Mot N<?=($i+1) ?>
                        <span><?=(isset($_SESSION["mot"][$i]) AND isthisStringValide($_SESSION["mot"][$i]) AND getLength($_SESSION["mot"][$i])<= 20)?'':"(Le mot doit pas depasser 20 caracters)"?></span>
                    </label>
                    <div>
                        <input type="text" name="mot[]" id="<?=($i+1) ?>" class="input-field" value="<?=(isset($_SESSION["mot"][$i])?$_SESSION["mot"][$i]:'')?>">
                    </div>
                <?php
                }
                echo '<button class="btn green" name="result" id="result">Resultat</button>';
            }
            if(isset($_POST["reset"])){
                session_destroy();
            }
        ?>
    </form>
</div>

<style>
.input-field {
    width: 50%;
    padding-left: 10px;
    height: 35px;
    margin-bottom: 25px;
    border-radius: 5px;
    border: 1px solid #f2f2f2;
}
.btn {
    width: 25%;
    height:35px;
    color: white;
    border: none;
    font-weight: bold;
    border-radius: 5px;
    margin-bottom: 25px;
}
.btn.blue{
    background-color: blue;
}
.btn.red{
    background-color: red;
}
.btn.green{
    background-color: green;
}
label{
    display:block;
    width: 50%;
    padding-left: 10px;
    margin-bottom: 10px;
}
</style>
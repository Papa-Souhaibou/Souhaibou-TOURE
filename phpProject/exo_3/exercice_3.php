<?php
    include('includes/exo_3.inc.php');
?>
<div id="form1">
    <form action="#" method="post">
        <div>
            <label for="nbr">Combien de mots</label><br>
            <input type="text" class="input-field" name="nbr" id="nbr" value="<?= @$_POST["nbr"] ?>">
        </div>
        <button type="submit" class="btn blue" name="submit">Valider</button>
        <input type="reset" class="btn red" value="Annuler" name="reset">
        <?php
            $nbr = (int)(isset($_POST["submit"])&&!empty($_POST["nbr"]))?$_POST["nbr"]:0;
            $_POST["error"] = 0;
            if((isset($_POST["submit"]) || isset($_POST["result"]))&&!empty($_POST["nombre"])){
                $nbr = (int)$_POST["nbr"];
                if($nbr > 0){
                    for ($i=0; $i < $nbr; $i++) { 
                    ?>
                        <div class="display-result">
                            <label for="<?=($i+1) ?>">Mot N°<?=($i+1) ?>
                            <?php
                                if(isset($_POST["result"])){
                                    $string = $_POST["mot"][$i];
                                    $length = getLength($string);
                                    if(!isThisStringValide($string) || $length > 20 || $string === ""){
                                        echo '<span class="error">Le mot ne doit pas depasser 20 caractere.</span>';
                                        $_POST["error"]++;
                                    }
                                }
                            ?>
                            </label>
                            <input type="text" name="mot[]" id="<?=($i+1) ?>" class="input-field" value="<?= @$_POST["mot"][$i] ?>">
                        </div>
                    <?php
                    }
                    echo '<button class="btn green" name="result" id="result">Resultat</button>';
                }
            }
            if(isset($_POST["reset"])){
                $length = getLength($_POST["mot"]);
                for ($i=0; $i < $length; $i++) { 
                    $_POST["mot"][$i] = '';
                }
            }
        ?>
    <div id="print">
        <p>
            <?php
            if(isset($_POST["result"])){
                $times = 0;
                $length = getLength($_POST['mot']);
                // $length = $nbr;
                for ($i=0; $i < $length; $i++) { 
                    $string = toUpperString($_POST["mot"][$i]);
                    if(isIn($string,"M")>=0 && isThisStringValide($string)){
                        $times++;
                    }
                }
                if($_POST["error"] === 0)
                    echo "Vous avez saisi $length Mot(s) dont <span class='result'>$times avec la lettre M</span>";
            }
            ?>
        </p>
    </div>
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
.error{
    color: red;
    margin-left: 25px;
}
.result{
    display:inline-block;
    padding: 10px 5px;
    border-radius: 5px;
    color:white;
    font-weigth: bold;
    background-color: rgba(26,86,3,0.7);
    /* height:0px; */
}
label{
    display:block;
    width: 50%;
    margin: auto;
}
</style>
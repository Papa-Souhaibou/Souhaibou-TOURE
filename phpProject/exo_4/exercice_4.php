<?php
    include('includes/exo_3.inc.php');
?>
<div id="form">
    <form action="#" method="post">
        <div>
            <label for="nbr">Vos phrases : </label><br>
            <textarea name="texte" id="" cols="30" rows="10"><?= @$_POST["texte"] ?></textarea>
        </div>
        <button type="submit" class="btn blue" name="submit">Valider</button>
        <input type="reset" class="btn red" value="Annuler" name="reset">
        <?php
            if(isset($_POST["submit"]) AND isset($_POST["texte"])){
                $texte = $_POST["texte"];
                preg_match_all("/\s*[[:alnum:]]+\.*\s*/",$texte,$result);
                $length = getLength($result[0]);
        ?>
        <div id="correction">
            <h2>Correction de Vos Phrases</h2>
            <textarea cols="30" rows="10" readonly>
            <?php
                $chaine = "";
                for ($i=0; $i < $length; $i++) { 
                    $string = clearSpaces($result[0][$i]);
                    $stringLength = getStringLength($string);
                    $string = $string[$stringLength - 1] === "." ? $string : clearRightSpaces($string).".";
                    if($stringLength <= 200){
                        $string[0] = toUpper($string[0]);
                        $string = clearRightSpaces($string);
                        $chaine .= $string." ";
                    }
                }
                echo $chaine;
            }
            ?>
            </textarea>
        </div>
    </form>
</div>
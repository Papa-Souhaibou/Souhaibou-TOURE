<?php
    include("includes/exo_3.inc.php");
?>
<form action="#" method="post">
    <label for="com">Vos numeros : </label>
    <textarea name="com" id="com" cols="30" rows="10"><?= @$_POST["com"] ?></textarea>
    <input type="submit" value="Envoyez" name="submit">
</form>
<?php
    if(isset($_POST["submit"]) AND $_POST["com"]){
        $commentaires = $_POST['com'];
        $nbr_num = preg_match_all("/(\d+[\s\-\;])+/",$commentaires,$result);
        $nb_free = 0;
        $nb_or = 0;
        $nb_ex = 0;
        $nb_ki = 0;
        $nb_pro = 0;
        $nb_err = 0;
        foreach ($result[0] as $value) {
            $value = preg_filter("/[\s\-\;]+/","",$value);
            if(getStringlength($value) === 9){
                preg_match("/^\d{2}/",$value,$ope);
                if($ope[0] == "70"){
                    $nb_ex++;
                }
                elseif ($ope[0] == "75") {
                    $nb_pro++;
                }
                elseif ($ope[0] == "76") {
                    $nb_free++;
                }
                elseif ($ope[0] == "77") {
                    $nb_or++;
                }
                elseif ($ope[0] == "78") {
                    $nb_ki++;
                }
            }else{
                $nb_err++;
            }
        }
        echo "<p>Orange : ".($nb_or*100)/$nbr_num."%</p>";
        echo "<p>Kirene : ".($nb_ki*100)/$nbr_num."%</p>";
        echo "<p>Free : ".($nb_free*100)/$nbr_num."%</p>";
        echo "<p>Expresso : ".($nb_ex*100)/$nbr_num."%</p>";
        echo "<p>Pro Mobile : ".($nb_pro*100)/$nbr_num."%</p>";
        echo "<p>Numero invalide : ".($nb_err*100)/$nbr_num."%</p>";
    }
?>
<style>
    .error{
        color: red;
    }
</style>
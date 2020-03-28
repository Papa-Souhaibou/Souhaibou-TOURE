<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/app_2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application 2</title>
    <?php
        $c1 = [
        "#fff" => "Blanc",
        "#f00" => "Rouge",
        "#0f0" => "Vert",
        "#00f" => "Bleue",
        "#000" => "Noir"
        ];
        $c2 = [
            "#808080" => "GRAY",
            "#CD5C5C" => "INDIANRED",
            "#800000" => "MAROON",
            "#FFFF00" => "YELLOW",
            "#00FF00" => "LIME",
            "#008080" => "TEAL",
            "#FF00FF" => "FUCHSIA"
        ];
    ?>
</head>
<body>
    <div class="container">
        <form action="#" method="post">
            <h1>SONATEL ACADEMIE PROJET 2</h1>
            <h3><label for="number">Taille de la matrice carree</label></h3>
            <div class="input-container">
                <i class="icon blue"><img src="img/icone1.png" alt=""></i>
                <input class="input-field" type="text" name="number" id="number"  value='<?=isset($_POST["number"]) ? $_POST["number"] : "";?>' placeholder="Que des nombres">
            </div>

            <h3><label for="c1">Select C1</label></h3>
            <div class="input-container">
                <i class="icon red"><img src="img/icone2_3.png" alt=""></i>
                <select name="c1" id="c1" class="input-field" value='<?=isset($_POST["c1"]) ? $_POST["c1"] : "";?>'>
                    <option value="#">Choisissez une couleur</option>
                    <?php
                        foreach ($c1 as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                    ?>
                </select>
            </div>
            <h3><label for="c2">Select C2</label></h3>
            <div class="input-container">
                <i class="icon green"><img src="img/icone2_3.png" alt=""></i>
                <select name="c2" id="c2" class="input-field" value='<?=isset($_POST["c2"]) ? $_POST["c2"] : "";?>'>
                        <option value="#">Choisissez une couleur</option>
                    <?php
                        foreach ($c2 as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                    ?>
                </select>
            </div>
            <h3><label for="c3">Select C3</label></h3>
            <div class="input-container">
                <i class="icon green"><img src="img/icone2_3.png" alt=""></i>
                <select name="c3" id="c3" class="input-field" value='<?=isset($_POST["c3"]) ? $_POST["c2"] : "";?>'>
                        <option value="#">Choisissez une couleur</option>
                    <?php
                        foreach ($c2 as $key => $value) {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                    ?>
                </select>
            </div>
            <button type="reset" class="btn gray">Annuler</button>
            <button type="submit" class="btn yellow">Dessiner</button>
        </form>
        <div id="table">
            <table>
                <?php
                    if(isset($_POST["number"]) && isset($_POST["c1"]) && isset($_POST["c2"]) && isset($_POST["c3"])){
                        $taille = (int)$_POST["number"];
                        if($taille <= 0){
                            echo "<p>La taille de la matrice doit etre strictement superieur a zero</p>";
                            die();
                        }
                        $c1 = $_POST["c1"];
                        $c2 = $_POST["c2"];
                        $c3 = $_POST["c3"];
                        if($c1 != $c2 AND $c2 != $c3){
                            for($i = 0; $i < $taille; $i++){
                                echo "<tr>";
                                for($j = 0; $j < $taille; $j++){
                                    if($i <= $j AND $j <= $taille-($i+1)){
                                        echo "<td style=' background-color:$c1;'></td>";
                                    }elseif($j < $taille-($i+1)){
                                        echo "<td style=' background-color:$c2;'></td>";
                                    }elseif ($i == $j OR $taille-($j+1)==$i) {
                                        echo "<td style=' background-color:$c1;'></td>";
                                    }elseif($i >= $j){
                                        echo "<td style=' background-color:$c3;'></td>";
                                    }
                                    else{
                                        echo "<td style=' background-color:$c2;'></td>";
                                    }
                                }
                                echo "</tr>";
                            }
                        }
                        else {
                            echo "<p class='msg'>Les couleurs doivent etre differentes</p>";
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
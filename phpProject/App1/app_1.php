<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/app_1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application 1</title>
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
            <h1>SONATEL ACADEMIE</h1>
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
            <h3><label for="pos">Position</label></h3>
            <div class="input-container">
                <i class="icon gray"><img src="img/interrogation.png" alt=""></i>
                <select name="pos" id="pos" class="input-field" value='<?=isset($_POST["pos"]) ? $_POST["pos"] : "";?>'>
                        <option value="#">Choisir la position</option>
                        <option value="haut">Haut</option>
                        <option value="bas">Bas</option>
                </select>
            </div>
            <button type="reset" class="btn gray">Annuler</button>
            <button type="submit" class="btn yellow">Dessiner</button>
        </form>
        <div id="table">
            <table>
                <?php
                    if(isset($_POST["number"]) && isset($_POST["c1"]) && isset($_POST["c2"]) && isset($_POST["pos"])){
                        $taille = (int)$_POST["number"];
                        if($taille <= 0){
                            echo "<p>La taille de la matrice doit etre strictement superieur a zero</p>";
                            die();
                        }
                        $c1 = $_POST["c1"];
                        $c2 = $_POST["c2"];
                        $position = $_POST["pos"];
                        for($i = 0; $i < $taille; $i++){
                            echo "<tr>";
                            for($j = 0; $j < $taille; $j++){
                                if($position === "haut"){
                                    if($j > $i){
                                        if($j >= ($i+1) AND $j < $taille-($i+1)){
                                            echo "<td style=' background-color:$c1;'></td>";
                                        }
                                        elseif($j == $taille-($i+1)){
                                            echo "<td style=' background-color:$c2;'></td>";
                                        }
                                        else{
                                            echo "<td style=' background-color:$c1;'></td>";
                                        }
                                    }
                                    else{
                                        echo "<td style=' background-color:$c2;'></td>";
                                    }
                                }
                                elseif($position === "bas"){
                                    if($j < $i){
                                        if($j >= ($i+1) AND $j < $taille-($i+1)){
                                            echo "<td style=' background-color:$c1;'></td>";
                                        }
                                        elseif($j == $taille-($i+1)){
                                            echo "<td style=' background-color:$c2;'></td>";
                                        }
                                        else{
                                            echo "<td style=' background-color:$c1;'></td>";
                                        }
                                    }
                                    else{
                                        echo "<td style=' background-color:$c2;'></td>";
                                    }
                                }
                                
                            }
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
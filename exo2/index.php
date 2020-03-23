<?php 
    $calendrier = [
        1 => ["Janvier","January"],
        2 => ["Fevrier","February"],
        3 => ["Mars","March"],
        4 => ["Avril","April"],
        5 => ["Mai","May"],
        6 => ["Juin","June"],
        7 => ["Juillet","July"],
        8 => ["Aout","August"],
        9 => ["Septembre","September"],
        10 => ["Octobre","October"],
        11 => ["Novembre","November"],
        12 => ["Decembre","December"]
    ];
?>
<h1>Votre calendrier</h1>
<form action="#" method="post">
    <select name="lang" id="">
        <option value="#">Choisissez votre langue</option>
        <option value="fr">Francais</option>
        <option value="ang">Anglais</option>
    </select>
    <input type="submit" value="Envoyer">
</form>
<?php 
    if(isset($_POST["lang"])){
?>
    <div id="table">
        <table>
        <?php
            for ($i=1; $i <12 ; $i+=3) { 
                echo "<tr>";
                for ($j=$i; $j < $i+3; $j++) { 
                    echo "<td>",$j,"</td>";
                    if($_POST["lang"] === "fr")
                        echo "<td>",$calendrier[$j][0],"</td>";
                    else if($_POST["lang"] === "ang")
                        echo "<td>",$calendrier[$j][1],"</td>";
                }
                echo "</tr>";
            }
        ?>
        </table>
    </div>
<?php
    }
?>
<style>
    #table {
        margin-top: 25px;
    }
    table {
        width: 80%;
        margin: auto;
        border-collapse: collapse;
    }
    #table > table,#table tr,#table td{
        border: solid 2px;
    }
    #table tr:nth-child(even){
        background-color: #f2f2f2;
    }
    #table td{
        padding: 15px;
    }
</style>
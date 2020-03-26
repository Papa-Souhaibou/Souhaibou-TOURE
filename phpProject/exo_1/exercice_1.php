<?php
    session_start();
    include("includes/functions.inc.php");
?>
<form action="#" method="post">
    <label for="number">Entrez un nombre <input type="number" name="number" id="number"></label>
    <input type="submit" value="Envoyer">
</form>
<?php
    $number = 0;
    $_SESSION['number'] = 0;
    if(isset($_POST['number'])){
        $number = (int)$_POST['number'];
        $_SESSION['number'] = $number;
    }
    if($_SESSION['number'] >= 10000){
        $result = primer($_SESSION['number']);
        $T1 = $result[0];
        $sizeT1 = $result[1];
        $T["inferieur"] = [];
        $T['superieur'] = [];
        $moy = moyenne($T1,$sizeT1);
        for($i = 0; $i < $sizeT1; $i++){
            if($T1[$i] < $moy){
                $T["inferieur"][] = $T1[$i];
            }else {
                $T['superieur'][] = $T1[$i];
            }
        }
        $_SESSION['prime'] = $T1;
        $nbre_total_articles = $sizeT1;
        $nbre_articles_par_page = 100;
        $nbre_de_page = ceil($nbre_total_articles / $nbre_articles_par_page);
        if(isset($_GET['page'])){
            $page_actuelle = (int) $_GET['page'];
            if ($page_actuelle > $nbre_de_page) {
                $page_actuelle = $nbre_de_page;
            }else if($page_actuelle < 1){
                $page_actuelle = 1;
            }
        }else {
            $page_actuelle = 1;
        }
        $start = ($page_actuelle - 1) * $nbre_articles_par_page;
        $end = $start + $nbre_articles_par_page;
        echo "<h1>Système de Pagination en PHP</h1>";
        echo "<p><strong>($nbre_total_articles)</strong> nombre premier au total !<br/>";
        echo "Page <b>$page_actuelle</b> sur <b>$nbre_de_page</a>";
        echo '<div id="prime">';
        createTab($T1,$start,$end,$sizeT1,"<h2>Nombre premier de 0 a $_SESSION[number]</h2>");
        echo '</div>';
        pagination($nbre_de_page,$nbre_articles_par_page);
    }
    else {
        echo "Votre valeur doit etre superieur ou egal a 10000";
    }
?>

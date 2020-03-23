<?php
    function primer($number){
        $array = [];
        $size = 0;
        for($i = 2; $i <= $number; $i++) { 
            if(est_premier($i)){
                $array[] = $i;
                $size++;
            }
        }
        $result[] = $array;
        $result[] = $size;
        return $result;
    }
    function est_premier($number){
        for($i = 2; $i < $number; $i++){
            if( $number % $i == 0){
                return false;
            }
        }
        return true;
    }
    function moyenne($array,$arraySize){
        $somme = 0;
        for($i = 0; $i < $arraySize; $i++){
            $somme += $array[$i];
        }
        return $somme / $arraySize;
    }
    function pagination($nbrPage,$nbrParPage){
        $nbre_pages_max_gauche_et_droite = 4;
        if(isset($_GET['page'])){
            $page_actuelle = (int)$_GET["page"];
            if($page_actuelle > $nbrPage){
                $page_actuelle = $nbrPage;
            }elseif ($page_actuelle < 1) {
                $page_actuelle = 1;
            }
        }else {
            $page_actuelle = 1;
        }
        $link = "";
        if($nbrPage != 1){
            if($page_actuelle > 1){
                $previous = $page_actuelle - 1;
                $link .= '<a href="index.php?p=exo_1&page='.$previous.'">Précédent</a> &nbsp; &nbsp;';
                for ($i = $page_actuelle - $nbre_pages_max_gauche_et_droite; $i < $page_actuelle; $i++) { 
                    if ($i > 0) {
                        $link .= '<a href="index.php?p=exo_1&page='.$i.'">'.$i.'</a> &nbsp;';
                    }
                }
            }
            $link .= '<span class="active">'.$page_actuelle.'</span>&nbsp;';
            for($i = $page_actuelle+1; $i <= $nbrPage; $i++){
                $link .= '<a href="index.php?p=exo_1&page='.$i.'">'.$i.'</a> ';
                if($i >= $page_actuelle + $nbre_pages_max_gauche_et_droite)
                    break;
            }
            if($page_actuelle != $nbrPage){
                $next = $page_actuelle + 1;
                $link .= '<a href="index.php?p=exo_1&page='.$next.'">Suivant</a> ';
            }
        }
        echo '<div id="pagination">'.$link.'</div>';
    }
    function createTab($array,$start,$nbrParPage,$arraySize,$texte){
        echo "<table>";
        echo $texte;
        for ($i=$start; (($i < $nbrParPage) && ($i+4 < $arraySize)); $i+=4) { 
            echo "<tr>";
            for ($j=$i; $j <= $i+4; $j++) { 
                echo "<td>".$array[$j]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>
<style>
    #pagination {
        background-color: #eaeaea;
        width: 80%;
        margin: auto;
        padding: 10px;
        margin-top: 25px;
    }
    #pagination .active{
        background-color: #012;
        color: #FFF;
        padding: 0px 5px 0px 5px;
        border-radius: 20%;
    }
    #pagination a, a:visited{
        color: blue;
        text-decoration: none;
    }
    #prime{
        width: 100%;
    }
    #prime > table{
       width: 80%;
       margin:auto;
       border-collapse: collapse;
    }
    #prime > table,#prime tr,#prime td{
        border: solid 2px;
    }
    #prime tr:nth-child(even){
        background-color: #f2f2f2;
    }
    #prime td{
        padding: 15px;
    }
</style>
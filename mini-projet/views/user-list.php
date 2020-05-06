<div id="user-list">
    <h1>Liste des Joueurs par Score</h1>
    <div id="list">
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Score</th>
            </tr>
            <?php
                usort($data["users"],function ($a,$b){
                    return $a["score"] < $b["score"];
                });
                $sotedArray = $data["users"];
                $nbre_total_utilisateur = count($sotedArray);
                $nbre_utilisateur_par_page = 15;
                $nbre_de_page = ceil($nbre_total_utilisateur / $nbre_utilisateur_par_page);
                if(isset($_GET["page"]))
                {
                    $page_actuelle = (int) $_GET["page"];
                    if($page_actuelle > $nbre_de_page){
                        $page_actuelle = $nbre_de_page;
                    }else if($page_actuelle < 0){
                        $page_actuelle = 1;
                    }
                }else{
                    $page_actuelle = 1;
                }
                $start = ($page_actuelle - 1) * $nbre_utilisateur_par_page;
                $end = $start + $nbre_utilisateur_par_page;
                if($nbre_total_utilisateur > $nbre_utilisateur_par_page){
                    for ($i=$start; $i < $end; $i++) { 
                        if(isset($sotedArray[$i])){
                    ?>
                        <tr>
                            <td><?= $sotedArray[$i]["lastname"]?></td>
                            <td><?= $sotedArray[$i]["firstname"]?></td>
                            <td><?= $sotedArray[$i]["score"]." pts"?></td>
                        </tr>
                    <?php
                        }
                    }
                }
            ?>
        </table>
        <?php
            if($nbre_total_utilisateur > $nbre_utilisateur_par_page){
                if($page_actuelle + 1 <= $nbre_de_page){
                    echo '<a href="settings.php?page='.($page_actuelle + 1).'#user-list">Suivant</a>';
                }else {
                    echo '<a href="settings.php?page='.($page_actuelle - 1).'#user-list">Precedent</a>';
                }
            }
        ?>
    </div>
</div>
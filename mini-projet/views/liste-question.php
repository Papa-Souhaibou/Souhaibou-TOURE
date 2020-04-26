<div id="liste-question">
    <form action="" method="post">
        <div id="question-number">
            <label for="question-number-field">Nombre de question/Jeu</label>
            <input type="text" class="question-number-field" id="question-number-field" name="number">
            <button type="submit" class="btn-valid-number">OK</button>
        </div>
    </form>
    <div id="questions">
        <?php
            include_once("../models/questions.php");
            $questions = get_question_list();
            $nbr_total_question = count($questions);
            $nbr_question_par_page = 5;
            $nbr_page = ceil($nbr_total_question / $nbr_question_par_page);
            if(isset($_GET["page"]))
            {
                $page_actuelle = (int) $_GET["page"];
                if($page_actuelle > $nbr_page){
                    $page_actuelle = $nbr_page;
                }else if($page_actuelle <= 0){
                    $page_actuelle = 1;
                }
            }else{
                $page_actuelle = 1;
            }
            $start = ($page_actuelle - 1) * $nbr_question_par_page;
            $end = $start + $nbr_question_par_page;
        ?>
        <div id="question-contents">
            <?php
                for ($i = $start; $i < $end; $i++) { 
                    if(isset($questions[$i])){
                        $response = $questions[$i]["reponse"];
                        $choixMultiple = $questions[$i]["choix"];
                        $type = $questions[$i]["typeReponse"];
                    ?>
                        <div class="question-content">
                        <?php
                            echo "<h3>",($i+1),". ",$questions[$i]["enonce"],"</h3>";
                            foreach ($choixMultiple as $value) {
                                if($type === "text"){
                                    echo '<input type="text" value="',$response,'" class="text" disabled>';
                                }else if($type === "checkbox"){
                                    if(in_array($value,$response)){
                                        echo '<input type="checkbox" checked disabled> <h4 class="in-line">',$value,'</h4><br/>';
                                    }else {
                                        echo '<input type="checkbox" disabled> <h4 class="in-line">',$value,'</h4><br/>';
                                    }
                                }else if($type === "radio"){
                                    if($value === $response){
                                        echo '<input type="radio" checked disabled> <h4 class="in-line">',$value,'</h4><br/>';
                                    }else {
                                        echo '<input type="radio" disabled> <h4 class="in-line">',$value,'</h4><br/>';
                                    }
                                }
                            }
                        ?>
                        </div>
                    <?php
                    }
                }
                ?>
                <div id="navigation">
                <?php
                if($page_actuelle > 1){
                    echo '<a href="settings.php?page='.($page_actuelle - 1).'#liste-question" class="previous"> Precedent</a>';
                }
                if($page_actuelle >= 1 AND $page_actuelle < $nbr_page){
                    echo '<a href="settings.php?page='.($page_actuelle + 1).'#liste-question" class="next"> Suivant</a>';
                }
                ?>
                </div>
                <?php
            ?>
        </div>
    </div>
</div>
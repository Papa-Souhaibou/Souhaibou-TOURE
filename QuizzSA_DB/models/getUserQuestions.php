<?php
    include_once("./databaseAccess.php");
    global $questionManager;
    global $db;
    $request = "SELECT q.idQuestion,ennonceQuestion,typeQuestion,choixPossible,reponse,note
    FROM joueurs j, questions q
        RIGHT JOIN trouver t on q.idQuestion != t.idQuestion
        WHERE t.idJoueur = j.idJoueur
    ";
    $response = $db->query($request);
    $questions = [];
    while($data = $response->fetch(PDO::FETCH_ASSOC)){
        if($data["typeQuestion"] === "checkbox" || $data["typeQuestion"] === "radio"){
            $data["choixPossible"] = explode(",",$data["choixPossible"]);
            $data["reponse"] = explode(",",$data["reponse"]);
        }
        $question = new Question($data);
        $questions[] = $question;
    }
    echo json_encode($questions);
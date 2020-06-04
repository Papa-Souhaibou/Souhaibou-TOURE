<?php
    class QuestionManager 
    {
        private $db;
        
        public function __construct(PDO $db){
            $this->setDb($db);
        }

        public function add(Question $question){
            $response = $this->db->prepare("INSERT INTO 
            questions(ennonceQuestion,typeQuestion,choixPossible,reponse,note,idAdmin)
            VALUES(:ennonceQuestion,:typeQuestion,:choixPossible,:reponse,:note,:idAdmin)
            ");
            $response->bindValue(":ennonceQuestion",$question->getEnnonceQuestion());
            $response->bindValue(":typeQuestion",$question->getTypeQuestion());
            $response->bindValue(":choixPossible",$question->getChoixPossible());
            $response->bindValue(":reponse",$question->getReponse());
            $response->bindValue(":note",$question->getNote());
            $response->bindValue(":idAdmin",$question->getIdAdmin());
            $response->execute();
            $response->closeCursor();
        }

        public function getListQuestion(){
            $questions = [];
            $response = $this->db->query("SELECT * FROM questions");
            while ($data = $response->fetch(PDO::FETCH_ASSOC)) {
                $question = new Question($data);
                $questions[] = $question;
            }
            $response->closeCursor();
            return $questions;
        }

        public function delete(int $id){
            $response = $this->db->prepare("DELETE FROM questions WHERE idQuestion = :idQuestion");
            $response->bindValue(":idQuestion",$id);
            $response->execute();
            $response->closeCursor();
        }

        /**
         * Get the value of db
         */ 
        public function getDb()
        {
            return $this->db;
        }

        public function setDb($db)
        {
            $this->db = $db;
        }
    }
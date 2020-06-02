<?php
    class Question implements JsonSerializable
    {
        private $idQuestion,
                $ennonceQuestion,
                $typeQuestion,
                $choixPossible,
                $reponse,
                $note,
                $idAdmin;

        public function __construct(array $data){
            $this->hydrate($data);
        }

        private function hydrate(array $data){
            foreach ($data as $key => $value) {
                $method = "set".ucfirst($key);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }
            }
        }

        public function jsonSerialize(){
            return [
                "idQuestion" => $this->getIdQuestion(),
                "ennonceQuestion" => $this->getEnnonceQuestion(),
                "typeQuestion" => $this->getTypeQuestion(),
                "choixPossible" => $this->getChoixPossible(),
                "reponse" => $this->getReponse(),
                "note" => $this->getNote(),
                "idAdmin" => $this->getIdAdmin()
            ];
        }

        /**
         * Get the value of idQuestion
         */ 
        public function getIdQuestion()
        {
            return $this->idQuestion;
        }

        public function setIdQuestion($idQuestion)
        {
            $this->idQuestion = (int)$idQuestion;
        }

        /**
         * Get the value of ennonceQuestion
         */ 
        public function getEnnonceQuestion()
        {
            return $this->ennonceQuestion;
        }

        public function setEnnonceQuestion($ennonceQuestion)
        {
            $this->ennonceQuestion = $ennonceQuestion;
        }

        /**
         * Get the value of typeQuestion
         */ 
        public function getTypeQuestion()
        {
            return $this->typeQuestion;
        }

        public function setTypeQuestion($typeQuestion)
        {
            $this->typeQuestion = $typeQuestion;
        }

        /**
         * Get the value of choixPossible
         */ 
        public function getChoixPossible()
        {
            return $this->choixPossible;
        }

        public function setChoixPossible($choixPossible)
        {
            $this->choixPossible = $choixPossible;
        }

        /**
         * Get the value of reponse
         */ 
        public function getReponse()
        {
            return $this->reponse;
        }

        public function setReponse($reponse)
        {
            $this->reponse = $reponse;
        }

        /**
         * Get the value of note
         */ 
        public function getNote()
        {
            return $this->note;
        }

        public function setNote($note)
        {
            $this->note = $note;
        }

        /**
         * Get the value of idAdmin
         */ 
        public function getIdAdmin()
        {
            return $this->idAdmin;
        }

        public function setIdAdmin($idAdmin)
        {
            $this->idAdmin = (int)$idAdmin;
        }
    }
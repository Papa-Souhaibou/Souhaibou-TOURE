<?php
    class Player implements JsonSerializable
    {
        private $idJoueur,
                $prenomJoueur,
                $nomJoueur,
                $loginJoueur,
                $avatarJoueur,
                $passwordJoueur,
                $scoreJoueur,
                $statusJoueur; 
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
                "idJoueur" => $this->getIdJoueur(),
                "prenomJoueur" => $this->getPrenomJoueur(),
                "nomJoueur" => $this->getNomJoueur(),
                "loginJoueur" => $this->getLoginJoueur(),
                "avatarJoueur" => $this->getAvatarJoueur(),
                "passwordJoueur" => $this->getPasswordJoueur(),
                "scoreJoueur" => $this->getScoreJoueur(),
                "statusJoueur" => $this->getStatusJoueur()
            ];
        }

        /**
         * Get the value of idJoueur
         */ 
        public function getIdJoueur()
        {
            return $this->idJoueur;
        }

        public function setIdJoueur($idJoueur)
        {
            $this->idJoueur = (int)$idJoueur;
        }

        /**
         * Get the value of prenomJoueur
         */ 
        public function getPrenomJoueur()
        {
            return $this->prenomJoueur;
        }

        public function setPrenomJoueur($prenomJoueur)
        {
            $this->prenomJoueur = $prenomJoueur;
        }
        
        /**
         * Get the value of nomJoueur
         */ 
        public function getNomJoueur()
        {
            return $this->nomJoueur;
        }

        public function setNomJoueur($nomJoueur)
        {
            $this->nomJoueur = $nomJoueur;
        }

        /**
         * Get the value of loginJoueur
         */ 
        public function getLoginJoueur()
        {
            return $this->loginJoueur;
        }

        public function setLoginJoueur($loginJoueur)
        {
            $this->loginJoueur = $loginJoueur;
        }

        /**
         * Get the value of avatarJoueur
         */ 
        public function getAvatarJoueur()
        {
            return $this->avatarJoueur;
        }
 
        public function setAvatarJoueur($avatarJoueur)
        {
            $this->avatarJoueur = $avatarJoueur;
        }

        /**
         * Get the value of passwordJoueur
         */ 
        public function getPasswordJoueur()
        {
            return $this->passwordJoueur;
        }

        public function setPasswordJoueur($passwordJoueur)
        {
            $this->passwordJoueur = $passwordJoueur;
        }

        /**
         * Get the value of scoreJoueur
         */ 
        public function getScoreJoueur()
        {
            return $this->scoreJoueur;
        }

        public function setScoreJoueur($scoreJoueur)
        {
            $this->scoreJoueur = (int)$scoreJoueur;
        }

        /**
         * Get the value of statusJoueur
         */ 
        public function getStatusJoueur()
        {
            return $this->statusJoueur;
        }

        public function setStatusJoueur($statusJoueur)
        {
            $this->statusJoueur = $statusJoueur;
        }
    }

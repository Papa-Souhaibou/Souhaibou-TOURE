<?php
    class Admin 
    {
        private $idAdmin,
                $loginAdmin,
                $passwordAdmin,
                $avatarAdmin,
                $prenomAdmin,
                $nomAdmin;
        
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
                "idAdmin" => $this->getIdAdmin(),
                "prenomAdmin" => $this->getPrenomAdmin(),
                "nomAdmin" => $this->getNomAdmin(),
                "loginAdmin" => $this->getLoginAdmin(),
                "avatarAdmin" => $this->getAvatarAdmin(),
                "passwordAdmin" => $this->getPasswordAdmin(),
            ];
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
            $this->idAdmin = $idAdmin;
        }

        /**
         * Get the value of loginAdmin
         */ 
        public function getLoginAdmin()
        {
            return $this->loginAdmin;
        }

        public function setLoginAdmin($loginAdmin)
        {
            $this->loginAdmin = $loginAdmin;
        }

        /**
         * Get the value of passwordAdmin
         */ 
        public function getPasswordAdmin()
        {
            return $this->passwordAdmin;
        }
 
        public function setPasswordAdmin($passwordAdmin)
        {
            $this->passwordAdmin = $passwordAdmin;
        }

        /**
         * Get the value of avatarAdmin
         */ 
        public function getAvatarAdmin()
        {
            return $this->avatarAdmin;
        }

        public function setAvatarAdmin($avatarAdmin)
        {
            $this->avatarAdmin = $avatarAdmin;
        }

        /**
         * Get the value of prenomAdmin
         */ 
        public function getPrenomAdmin()
        {
            return $this->prenomAdmin;
        }

        public function setPrenomAdmin($prenomAdmin)
        {
            $this->prenomAdmin = $prenomAdmin;
        }

        /**
         * Get the value of nomAdmin
         */ 
        public function getNomAdmin()
        {
            return $this->nomAdmin;
        }
 
        public function setNomAdmin($nomAdmin)
        {
            $this->nomAdmin = $nomAdmin;
        }
    }
<?php
    class AdminManager
    {
        private $db;
        
        public function __construct(PDO $db){
            $this->setDb($db);
        }

        public function getAdmin($info){
            if(is_int($info)){
                $response = $this->db->prepare(
                    "SELECT * FROM administrateur
                        WHERE idAdmin = :idAdmin
                ");
                $response->bindValue(":idJoueur",$info);
                $response->execute();
                $data = $response->fetch(PDO::FETCH_ASSOC);
                $response->closeCursor();
                if($data){
                    return new Admin($data);
                }
            }else{
                $response = $this->db->prepare(
                    "SELECT * FROM administrateur
                        WHERE loginAdmin = :loginAdmin
                ");
                $response->bindValue(":loginAdmin",$info);
                $response->execute();
                $data = $response->fetch(PDO::FETCH_ASSOC);
                $response->closeCursor();
                if($data){
                    return new Admin($data);
                }
            }
            return null;
        }

        public function getAdminsList(){
            $admins = [];
            $response = $this->db->query("SELECT * FROM administrateur");
            while ($data = $response->fetch(PDO::FETCH_ASSOC)) {
                $admin = new Admin($data);
                $admins[] = $admin;
            }
            return $admins;
        }

        /**
         * Get the value of db
         */ 
        public function getDb()
        {
            return $this->db;
        }

        /**
         * Set the value of db
         *
         * @return  self
         */ 
        public function setDb($db)
        {
            $this->db = $db;
        }
    }
    
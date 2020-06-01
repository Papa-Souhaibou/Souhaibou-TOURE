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
                $response->bindValue(":idAdmin",$info);
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
            $response->closeCursor();
            return $admins;
        }

        public function add(Admin $admin){
            $response = $this->db->prepare("INSERT INTO 
            administrateur(prenomAdmin,nomAdmin,loginAdmin,avatarAdmin,passwordAdmin)
            VALUES(:prenomAdmin,:nomAdmin,:loginAdmin,:avatarAdmin,:passwordAdmin)
            ");
            $response->bindValue(":prenomAdmin",$admin->getPrenomAdmin());
            $response->bindValue(":nomAdmin",$admin->getNomAdmin());
            $response->bindValue(":loginAdmin",$admin->getLoginAdmin());
            $response->bindValue(":avatarAdmin",$admin->getAvatarAdmin());
            $response->bindValue(":passwordAdmin",$admin->getPasswordAdmin());
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
    
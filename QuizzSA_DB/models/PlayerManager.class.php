<?php
    class PlayerManager 
    {
        private $db;
        
        public function __construct(PDO $db){
            $this->setDb($db);
        }

        public function add(Player $player){
            $response = $this->db->prepare("INSERT INTO 
            joueurs(prenomJoueur,nomJoueur,loginJoueur,avatarJoueur,passwordJoueur,scoreJoueur,statusJoueur)
            VALUES(:prenomJoueur,:nomJoueur,:loginJoueur,:avatarJoueur,:passwordJoueur,:scoreJoueur,:statusJoueur)
            ");
            $response->bindValue(":prenomJoueur",$player->getPrenomJoueur());
            $response->bindValue(":nomJoueur",$player->getNomJoueur());
            $response->bindValue(":loginJoueur",$player->getLoginJoueur());
            $response->bindValue(":avatarJoueur",$player->getAvatarJoueur());
            $response->bindValue(":passwordJoueur",$player->getPasswordJoueur());
            $response->bindValue(":scoreJoueur",$player->getScoreJoueur());
            $response->bindValue(":statusJoueur",$player->getStatusJoueur());
            $response->execute();
        }

        public function getListUser(){
            $players = [];
            $response = $this->db->query("SELECT * FROM joueurs");
            while ($data = $response->fetch(PDO::FETCH_ASSOC)) {
                // var_dump($data["passwordJoeur"]);
                $player = new Player($data);
                $players[] = $player;
            }
            $response->closeCursor();
            return $players;
        }
        public function getPlayer($info){
            if(is_int($info)){
                $response = $this->db->prepare(
                    "SELECT * FROM joueurs
                        WHERE idJoueur = :idJoueur
                ");
                $response->bindValue(":idJoueur",$info);
                $response->execute();
                $data = $response->fetch(PDO::FETCH_ASSOC);
                $response->closeCursor();
                if($data){
                    return new Player($data);
                }
            }else{
                $response = $this->db->prepare(
                    "SELECT * FROM joueurs
                        WHERE loginJoueur = :loginJoueur
                ");
                $response->bindValue(":loginJoueur",$info);
                $response->execute();
                $data = $response->fetch(PDO::FETCH_ASSOC);
                $response->closeCursor();
                if($data){
                    return new Player($data);
                }
            }
            return null;
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
    
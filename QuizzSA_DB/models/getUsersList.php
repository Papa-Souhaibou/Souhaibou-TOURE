<?php
    include_once("./databaseAccess.php");
    function objToArray(array $obj){
        $array = [];
        foreach ($obj as $value) {
            $array[] = $value->jsonSerialize();
        }
        return $array;
    }
    if(isset($_POST["login"])){
        $players = $playerManager->getListUser();
        $admins = $adminManager->getAdminsList();
        $listPlayer = objToArray($players);
        $listAdmin = objToArray($admins);
        $users = array_merge($listPlayer,$listAdmin);
        $users = json_encode($users);
        echo $users;
    }elseif ($_POST["admin"]) {
        $admins = $adminManager->getAdminsList();
        echo json_encode($admins);
    }
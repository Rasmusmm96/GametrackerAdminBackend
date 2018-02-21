<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once "DAL/admindataaccess.php";

$dataaccess = new AdminDataAccess();

class AdminManager {

    public function addAdmin($username, $password) {
        global $dataaccess;

        $password = password_hash($password, PASSWORD_DEFAULT);

        return $dataaccess->addAdmin($username, $password);
    }

    public function login($username, $password) {
        global $dataaccess;

        $admin = $dataaccess->getAdminByUsername($username);

        if(password_verify($password, $admin['Password'])) {
            $return = array();
            $return['Id'] = $admin['Id'];
            $return['Username'] = $admin['Username'];

            return $return;
        } else {
            return false;
        }
    }
}

?>

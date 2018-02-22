<?php
use Lcobucci\JWT\Builder;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

require_once "DAL/admindataaccess.php";
require_once "DLL/commonfunctions.php";

$admindataaccess = new AdminDataAccess();
$commonfunctions = new CommonFunctions();

class AdminManager {

    public function addAdmin($username, $password, $token) {
        global $admindataaccess;
        global $commonfunctions;

        if (!$commonfunctions->validate($token)) {
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        return $admindataaccess->addAdmin($username, $password);
    }

    public function login($username, $password) {
        global $admindataaccess;
        global $commonfunctions;

        $admin = $admindataaccess->getAdminByUsername($username);

        if(password_verify($password, $admin['Password'])) {
            $token = (new Builder())->setIssuer('GameTracker') // Configures the issuer (iss claim)
                                    ->setId($commonfunctions->tokenId, true) // Configures the id (jti claim), replicating as a header item
                                    ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                                    ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
                                    ->set('Username', $admin['Username']) // Configures a new claim, called "uid"
                                    ->getToken(); // Retrieves the generated token
            $return = array();
            $return['Token'] = (string)$token;

            return $return;
        } else {
            return false;
        }
    }
}

?>

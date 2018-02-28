<?php

require_once "DAL/gamedataaccess.php";
require_once "DLL/commonfunctions.php";

$gamedataaccess = new GameDataAccess();
$commonfunctions = new CommonFunctions();

class GameManager {

    public function addGame($game, $token) {
        global $gamedataaccess;
        global $commonfunctions;

        if (!$commonfunctions->validate($token)) {
            return false;
        }

        return $gamedataaccess->addGame($game);
    }

    public function updateGame($game, $token) {
        global $gamedataaccess;
        global $commonfunctions;

        if (!$commonfunctions->validate($token)) {
            return false;
        }

        return $gamedataaccess->updateGame($game);
    }

    public function deleteGame($id, $token) {
        global $gamedataaccess;
        global $commonfunctions;

        if (!$commonfunctions->validate($token)) {
            return false;
        }

        return $gamedataaccess->deleteGame($id);
    }
}

?>

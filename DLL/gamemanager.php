<?php

require_once "DAL/gamedataaccess.php";
require_once "DLL/commonfunctions.php";

$gamedataaccess = new GameDataAccess();
$commonfunctions = new CommonFunctions();

class GameManager {

    public function addGame($title, $developer, $publisher, $releasedate, $token) {
        global $gamedataaccess;
        global $commonfunctions;

        if (!$commonfunctions->validate($token)) {
            return false;
        }

        return $gamedataaccess->addGame($title, $developer, $publisher, $releasedate);
    }

    public function updateGame($id, $title, $developer, $publisher, $releasedate, $token) {
        global $gamedataaccess;
        global $commonfunctions;

        if (!$commonfunctions->validate($token)) {
            return false;
        }

        return $gamedataaccess->updateGame($id, $title, $developer, $publisher, $releasedate);
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

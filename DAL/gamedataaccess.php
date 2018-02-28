<?php

require_once 'BE/game.php';

class GameDataAccess {

    private function getDatabase() {
        $con = new mysqli(
            'localhost',
            'root',
            'root',
            'Gametracker',
            '8889');

        return $con;
    }

    public function addGame($game) {
        $db = $this->getDatabase();

        if ($game->title == null)
            return false;

        $statement = 'INSERT INTO Games (Title, Developer, Publisher, Release_Date, Twitter_Handle, Youtube_Id)
                      VALUES ("'. $game->title .'",
                              "'. $game->developer .'", 
                              "'. $game->publisher .'", 
                              "'. $game->releasedate .'",
                              "'. $game->twitter .'",
                              "'. $game->youtube .'")';

        $db->query($statement);

        if ($db->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateGame($game) {
        $db = $this->getDatabase();

        if ($game->title == null || $game->id == null)
            return false;

        $statement = 'UPDATE Games
                      SET Title = "'. $game->title .'", 
                          Developer = "'. $game->developer .'", 
                          Publisher = "'. $game->publisher .'", 
                          Release_Date = "'. $game->releasedate .'",
                          Twitter_Handle = "'. $game->twitter .'",
                          Youtube_Id = "'. $game->youtube .'"
                      WHERE ID = "'. $game->id .'"';

        $db->query($statement);

        if ($db->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteGame($id) {
        $db = $this->getDatabase();

        $statement = 'DELETE FROM Games WHERE ID = "'. $id .'"';

        $db->query($statement);

        if ($db->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

}
 ?>

<?php
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

    public function addGame($title, $developer, $publisher, $releasedate) {
        $db = $this->getDatabase();

        if ($title == null)
            return false;

        $statement = 'INSERT INTO Games (Title, Developer, Publisher, Release_Date)
                      VALUES ("'. $title .'", "'. $developer .'", "'. $publisher .'", "'. $releasedate .'")';

        $db->query($statement);

        if ($db->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function updateGame($id, $title, $developer, $publisher, $releasedate) {
        $db = $this->getDatabase();

        if ($title == null || $id == null)
            return false;

        $statement = 'UPDATE Games
                      SET Title = "'. $title .'", 
                          Developer = "'. $developer .'", 
                          Publisher = "'. $publisher .'", 
                          Release_Date = "'. $releasedate .'"
                      WHERE ID = "'. $id .'"';

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

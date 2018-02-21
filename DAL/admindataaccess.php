<?php
class AdminDataAccess {

    private function getDatabase() {
        $con = new mysqli(
            'localhost',
            'root',
            'root',
            'Gametracker',
            '8889');

        return $con;
    }

    public function addAdmin($username, $password) {
        $db = $this->getDatabase();

        $statement = 'INSERT INTO Admin (Username, Password)
                      VALUES ("'. $username .'", "'. $password .'")';

        $db->query($statement);

        if ($db->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminByUsername($username) {
        $db = $this->getDatabase();

        $statement = 'SELECT * FROM Admin WHERE Username = "'. $username .'"';

        return $db->query($statement)->fetch_assoc();
    }

}
?>

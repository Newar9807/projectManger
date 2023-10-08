<?php
// DB CONNECTION
// $conn = mysqli_connect('localhost', 'root', '', 'pms') or die("Error Database Connection");
class dbCon{

    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli('localhost', 'root', '', 'pms');
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

}

?>

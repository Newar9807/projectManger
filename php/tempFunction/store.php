<?php 
class store{
    private $conn ;

    public function __construct()
    {
        // DB connection
        include_once("../assets/dbCon.php");
        $Database = new dbCon();
        $this->conn = $Database->getConnection();
    }
}
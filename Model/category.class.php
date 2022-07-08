<?php

  //  require '../config.php';

class category
{
    private $conn;

    public function __construct()
    {
        global $db;
        $this->conn = $db;
    }

    public function getCategories()
    {
        $selectQuery = 'select * from categories';
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }
}

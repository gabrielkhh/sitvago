<?php

namespace sitvago;

class DB
{
    public $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sitvago_test_db";
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);
    }

    public static function create($servername, $username, $password, $dbname)
    {
        return new static($servername, $username, $password, $dbname);
    }
}

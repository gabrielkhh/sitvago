<?php

namespace sitvago;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

class DB
{
    public $conn;

    public function __construct()
    {
        $servername = $_SERVER['servername'];
        $username = $_SERVER['username'];
        $password = $_SERVER['password'];
        $dbname = $_SERVER['dbname'];
        
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);
    }

    public static function create($servername, $username, $password, $dbname)
    {
        return new static($servername, $username, $password, $dbname);
    }
}

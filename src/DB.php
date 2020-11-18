<?php

namespace sitvago;

class DB
{
    public $conn;

    public function __construct()
    {
        
        $config = parse_ini_file(__DIR__ . '/../config/db.ini');

        $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);
    }

    public static function create($servername, $username, $password, $dbname)
    {
        return new static($servername, $username, $password, $dbname);
    }
}

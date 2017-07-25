<?php


namespace Database;


class Database
{
    static private $instance = null;
    private $conn;


    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root","","ljudski_resursi");
       //  echo "Connected successfully";
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        } else {
            //  echo "Using the same object\n";
        }

        return self::$instance;
    }

    public function query()
    {
        return $this->conn;
    }
}

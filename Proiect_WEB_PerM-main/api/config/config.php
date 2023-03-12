<?php

class Db {

    private static $instance = null;
    private $conn; 

    private function __construct() {
        $this->conn = pg_connect("host=ec2-34-200-35-222.compute-1.amazonaws.com dbname=d7eti01efn7eso user=iynndjpzyjvrrd password=682ab6a1546d692f06b76217a45eeb5d51189179e50ca5f3c8576586d25fd990");
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>
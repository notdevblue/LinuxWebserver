<?php
require("./Util/send_error.php");

// raii 를 C++처럼 못쓰네 망할
class mysql
{
    private $conn;

    public function __construct($addr, $id, $pw, $db) {
        $this->conn = new mysqli($addr, $id, $pw, $db);

        if($this->conn->connect_error) {
            
            error("Cannot connect to Database.");
        }
    }

    public function query($query) {
        $this->conn->query($query);
    }

    public function close() {
        $this->conn->close();
    }

    public function __destruct() {
        // $this->conn->close(); 
        // echo "closed";
    }
}




?>
<?php
require_once "./util/send_error.php";

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
        return $this->conn->query($query);
    }

    public function to_array($result) {
        $arr = array();

        while($row = mysqli_fetch_array($result)) {
            array_push($arr, $row);
        }

        return $arr[0];
    }

    public function password_hash($pw) {
        return password_hash($pw, PASSWORD_DEFAULT);
    }

    public function password_verify($pw, $hash) {
        return password_verify($pw, $hash);
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
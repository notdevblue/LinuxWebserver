<?php

function error($message) {
    echo json_encode(new class($message) {
        public $msg = "";
        public function __construct($msg) {
            $this->msg = $msg;
        }
    });
    
    exit();
}

?>
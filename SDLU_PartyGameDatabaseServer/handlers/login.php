<?php
require_once "./util/send_error.php";
require_once "./util/query.php";

function handle($data) {
    if(empty($data["id"]) || empty($data["pw"])) {
        error("잘못된 요청입니다.");
    }

    $mysql = new mysql("localhost", "han", "1234", "study_db");
    $mysql->query("SELECT * FROM tb_users WHERE 1");
}


?>
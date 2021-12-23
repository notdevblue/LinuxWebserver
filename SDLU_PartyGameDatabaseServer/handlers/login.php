<?php
require_once "./util/send_error.php";
require_once "./util/query.php";

function handle($data) {
    if(empty($data->id) || empty($data->pw)) {
        error("잘못된 요청입니다.");
    }

    $mysql    = new mysql("localhost", "han", "1234", "study_db");
    $result   = $mysql->to_array($mysql->query("SELECT password FROM tb_users WHERE name='" . $data->id ."';"));
    $response = array();

    $response["type"]   = "login";
    $response["result"] = $mysql->password_verify($data->pw, $result["password"]);

    echo json_encode($response);
}


?>
<?php
require_once "./util/send_error.php";
require_once "./util/query.php";

function handle($data) {
    if(empty($data->id) || empty($data->pw)) {
        error("잘못된 요청입니다.");
    }

    $mysql    = new mysql("localhost", "han", "1234", "study_db");
    $result   = $mysql->to_array($mysql->query("SELECT COUNT(id) FROM tb_users WHERE name='" . $data->id . "';"));
    $response = array();
    $response["type"] = "register";

    if($result["COUNT(id)"] > 0) {
        $response["result"] = false;
        $response["msg"] = "이미 존재하는 아이디입니다.";
    } else {
        $result = $mysql->query("INSERT INTO tb_users (name, password) VALUES ('" . $data->id . "', '" . $mysql->password_hash($data->pw) . "');");
        if($result) {
            $response["result"] = true;
            $response["msg"]  = "성공적으로 가입했습니다.";
        } else {
            error("회원 가입 중 오류가 발생했습니다.");
        }
    }

    echo json_encode($response);
}

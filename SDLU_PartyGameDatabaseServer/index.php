<?php
require "init.php";
require "./util/send_error.php";

$post = $_POST;

if(empty($post["type"])) {
    error("type 이 없습니다.");
}

# lib include
$files = new FilesystemIterator('lib');
foreach($files as $fileInfo) {
    require_once $fileInfo->getFilename(); # 원석이 코드 빼껴오기
}

# $db = new mysql("localhost", $id, $password, "study_db");
# $db->close();

# handler include
try {
    require "./handlers/" . $post["type"] . ".php";
} catch(Exception $e) {
    error("type 에 해당하는 Handler 를 찾을 수 없습니다.");
}

handle($post["data"]);

?>
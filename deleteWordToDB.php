<?php
require "init.php";

$post = $_POST;
// $post[comment]
// $post[name]
// $post[password]


$tableName = "tb_comments";
$query = "SELECT * FROM " . $tableName .
    " WHERE " . "`name`='" . $post["name"] .
    "' AND " . "`password`=PASSWORD('" . $post["password"] . "');";

$dbAccess = mysqli_connect("localhost", "han", $_LOCALPW, "study_db");
$result = mysqli_query($dbAccess, $query) or die("DB query failed");

$effectedRows = $result->num_rows;
if ($effectedRows == 0) {
    echo "해당하는 글을 찾을 수 없습니다.";
    exit();
} else if ($effectedRows > 1) {
    // echo "에러. 우앱이에게 DM 을 보내줘요.";
    // exit();
    echo "아이디와 비번이 같은 글을 전부 삭제합니다.<br/>";
    echo "곧 수정될 것.<br/>";
}

$query = "DELETE FROM " . $tableName . " WHERE name='" . $post["name"] . "'";

$result = mysqli_query($dbAccess, $query) or die("DB delete query failed");

echo "성공적으로 삭제했습니다.";
?>

<html>

<body>
    <form action="index.php" method="post">
        <input type="submit" value="돌아가기">
    </form>
</body>

</html>
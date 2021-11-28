<?PHP
require "init.php";

$post = $_POST;
// $post[comment]
// $post[name]
// $post[password]

$tableName = "tb_comments";
$query = "INSERT INTO " . $tableName .
    " (name, comment, password) VALUES" .
    " ('" . $post["name"] . "', '" . $post["comment"] . "', password('" . $post["password"] . "'))";


$dbAccess = mysqli_connect("localhost", "han", $_LOCALPW, "study_db");
$result = mysqli_query($dbAccess, $query) or die("DB query failed");

echo "성공적으로 남겼습니다.";

mysqli_close($dbAccess);
$_POST = $post =  null;
?>

<html>

<body>
    <form action="index.php" method="POST">
        <input type="submit" value="돌아가기">
    </form>
</body>

</html>
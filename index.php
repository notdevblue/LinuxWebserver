<?php
require "init.php";

echo "<h2>커피</h2>";
echo "<h6>마시려면 아치 리눅스를</h6>";

$tableName = "tb_comments";
$dbAccess = mysqli_connect("localhost", "han", $_LOCALPW, "study_db");
$query = "SELECT * FROM " . $tableName . " ORDER BY id DESC;";

$result = mysqli_query($dbAccess, $query);
$resultDataArray = array();

if ($result !== false && $result->num_rows > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($resultDataArray, $row);
	}
}

mysqli_close($dbAccess);
?>


<html>

<body>
	<form action="addWordToDB.php" , method="POST">
		<div>
			이름<br />
			<input type="text" , name="name" , placeholder="여기에 이름 입력"><br />
			남길 말<br />
			<input type="text" , name="comment" , placeholder="여기에 남길 말 입력"><br />
			비밀번호<br />
			<input type="password" name="password" placeholder="password"><br /><br />
			<input type="submit" value="남기기">
		</div>
	</form>

	<form action="deleteWordToDB.php" method="POST">
		지울 글의 이름<br />
		<input type="text" name="name"><br />
		지울 글의 비밀번호<br />
		<input type="password" name="password"><br /><br />
		<input type="submit" value="지우기">
	</form>

	<?php
	echo "<br />";
	foreach ($resultDataArray as $key => $val) {
		echo $val["name"] . " : " . $val["date"] . "<br /><i>" . $val["comment"] . "</i>";
		echo "<br />";
		echo "<br />";
	}
	?>
</body>

</html>
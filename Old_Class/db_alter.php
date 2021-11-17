<?PHP

	require "init.php";

	$db_name = "study_db";
	$table_name = "tb_Users";

	$alter_table = "ALTER TABLE `";
	$alter_table .= $db_name . "`.`" . $table_name . "` ";
	$alter_table .= "ADD COLUMN `user_id` ";
	$alter_table .= "VARCHAR(1000) NOT NULL DEFAULT 0";
	$alter_table .= "AFTER `status`";

	$dbo = mysqli_connect("localhost", "Han", "1234", "study_db") or die("connect fail!!");
	// 주소, username, password, 데이터베이스 이름, port, socket
	// 127.0.0.1, 'root', 비번, 'datatable'
	
	$ret = mysqli_query($dbo, $alter_table) or die ("Error alter_table querying DB");

	$select_table = "SHOW FULL COLUMNS FROM ";
	$select_table .= $db_name . "." . $table_name . ";";
	$ret1 = mysqli_query($dbo, $select_table) or die ("Error select_table querying DB");


	$ret_select;
	if($ret1->num_rows > 0)
	{
		$cnt = 0;
		while($row = $ret1->fetch_assoc())
		{
			$ret_select .= "Field: " . $row["Field"] . " - Type: " . $row["Type"] . " Key : " . $row["Key"] . "<br>";
		}
	}
	else
	{
		$ret_select = "0 results";
	}

	p($ret_select);
	mysqli_close($dbo);
	
?>
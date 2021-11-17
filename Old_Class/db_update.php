<?PHP

	require "init.php";
	$post = $_POST;

	$db_name = "study_db";
	$table_name = "tb_Users";

	$select_table = "SELEC * FROM ";
	$select_table .= $db_name . "." . $table_name;
	$select_table .= " Where user_id = 0";

	$dbo = mysqli_connect("localhost", "Han", "1234", "study_db") or die("connect fail!!");
	$ret1 = mysqli_query($dbo, $select_table) or die ("Error select_table querying DB");

	$ret_row = array();
	if($ret1->num_rows > 0)
	{
		while($row = $ret1->fetch_assoc())
		{
			array_push($ret_row, $row[$id]);
		}
	}
	else
	{
		$ret_select = "0 results";
	}

	$ret_code = array();
	foreach($ret_row as $key => $val)
	{
		$ret_code = is_rendCode($ret_code);
	}


	foreach($ret_row as $key => $val)
	{
		$update_sql = "UPDATE `";
		$update_sql .= $db_name . "`.`" . $table_name . "` ";
		$update_sql .= "SET `user_id` = '" . $ret_code[$key];
		$update_sql .= "' WHERE (`id` = " . $val . ");";

		$ret_update	= mysqli_query($dbo, $update_sql) or die("Error update_sql querying DB");
	}


	$select_table = "SELECT * FROM " . $db_name . "." . $table_name . ";";
	$ret1 = mysqli_connect($dbo, $select_table) or die ("Error select_Table querying DB");
	

	$ret_select;
	if($ret1->num_rows > 0)
	{
		while($row = $ret->fetch_assoc())
		{
			$ret_select .= "id: " . $row["id"];
			$ret_select .= " - user_id: " . $row["user_id"];
			$ret_select .= " count: " . $row["count"];
			$ret_select .= " reg_date : " . $row["reg_date"] . "<br>";
		}
	}
	else
	{
		$ret_select = "0 results";
	}

	p($ret_select);
	


	mysqli_close($dbo);
?>

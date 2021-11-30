<?php
	require "init.php";

	## $_POST["id"] == 0
	$ret_post = $_POST;

	errorLog("UnityLog", $ret_post,  0);

		


	$ret_ids = explode("_", $ret_post["id"]);
	$id = $ret_ids[0];
	$count = $ret_ids[1];

	$table_name = "tb_users";

	$array = array();

	##query 실행...........
	##db connect
	$dbo = mysqli_connect('localhost', 'han', '1234', 'study_db');

	##db query
	$query = "
			SELECT user_id From " . $table_name . " Where status > 0;";
	$ret_query = mysqli_query($dbo, $query);

	if ($ret_query->num_rows > 0) {
		$row =  mysqli_fetch_array($ret_query);
		$array = $row;
	} else {
		$ret_cnt = 0;
	}



	##db close 
	$jsonArray = array();
	## 0이면 유저아이디를 만들고
	if ($id == 0) {
		$user_id =  is_rendCode($array);

		$query = "
				insert into " . $table_name . " (
					user_id, status
				) 
				values ( 
					'" . $user_id . "', 1
				); 
			";


		$jsonArray["user_id"] = $user_id;
		$jsonArray["count"] = 0;
	} else {
		## 유저아이디를 DB 저장


		#select$query = "

		$query = "SELECT count(*) From " . $table_name . " Where status > 0 and id=" . $id . ";";
		$ret_query = mysqli_query($dbo, $query);
		if ($ret_query->num_rows > 0) {

			#해당 id의 count +1
			#update
			## 0이 아니면 해당 유저아이디에 count를 증가신킨다.
			$count++;
			$query = "
					update " . $table_name . " SET count = " . $count . " WHERE status > 0 and id=" . $id;
		}
	}

	$ret_query = mysqli_query($dbo, $query);
	mysqli_close($dbo);

	$jsonret = json_encode($jsonArray);
	echo $jsonret;

?>
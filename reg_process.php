<?php
	require "init.php";

	## $_POST["id"] == 0
	$ret_post = $_POST;
	$array = array();
    
    // $id = $ret_post["id"];
    $ret_ids = explode("_", $ret_post["id"]);
    $id = $ret_ids[0];
    $count = $ret_ids[1];

	##query 실행...........
	##db connect
	$dbo = mysqli_connect('localhost', "HanUseArch", $_PW, 'project2');
	
	##db query
	$query = "
		SELECT user_id From tb_Users Where status > 0;";
	$ret_query = mysqli_query($dbo, $query);
	
	if($ret_query->num_rows > 0) { 
		$row =  mysqli_fetch_array($ret_query); 
		$array = $row;
	} else {
		$ret_cnt = 0;
	}
 
	##db close
    $jsonarray = array();   

	## 0이면 유저아이디를 만들고
	if($id == 0) {
		$user_id =  is_rendCode($array);	
		
		$query = "
			insert into tb_Users(
				user_id, status
			) 
			values ( 
				'" . $user_id[1] . "', 1
			); 
		";

        $jsonarray["user_id"] = $user_id[1];
        $jsonarray["count"] = 0;
	}
    else
    {
        $query = "SELECT count(*) FROM tb_Users WHERE status > 0 AND id=". $id .";";
        $ret_query = mysqli_query($dbo, $query);
    
        if($ret_query->num_rows > 0)
        {
            ++$count;
            $query = "UPDATE tb_Users SET count=" . $count . " WHERE status > 0 AND id=" . $id . ";";
        }
    }

    $ret_query_insert = mysqli_query($dbo, $query);
    mysqli_close($dbo);

    $jsonret = json_encode($jsonarray);

    echo $jsonret;
?>
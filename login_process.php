<?php
    require "init.php";

    $ret_post = $_POST;
    errorLog("UnityLog", $ret_post, 0);

    $table_name = "tb_UserInfos";

    $array = array();

    $dbo = mysqli_connect("localhost", "han", "1234", "study_db");


    $query = "SELECT * FROM " . $table_name . " WHERE status > 0";
    $ret_query = mysqli_query($dbo, $query);
    $jsonArray = array();

    // p($ret_query);
    // exit();

    if(($ret_query->num_rows > 0))
    {
        while($row = mysqli_fetch_assoc($ret_query)){
		array_push($jsonArray, $row);
            
	}
    } else {
	    $ret_cnt = 0;
    }

    $ret_query = mysqli_query($dbo, $query);
    mysqli_close($dbo);

    $ret_array = array("result"=>true, "jsonInfo"=>$jsonArray);
    $jsonret = json_encode($ret_array);
    echo $jsonret;
?>

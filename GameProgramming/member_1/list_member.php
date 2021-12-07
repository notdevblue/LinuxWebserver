<?php
    require "../../init.php";

    $post = $_POST;


    $loginId = empty($post["login_id"]) ? "test_id" : $post["login_id"];
    $loginPassword = empty($post["login_password"]) ? "1234" : $post["login_password"];
    $type = empty($post["type"]) ? 1 : $post["type"];

    #db connect
    $dbAccess = mysqli_connect("localhost", "han", $_LOCALPW, "study_db") or die("Connection Failed");

    $getAccountExistQuery = "SELECT id FROM tb_members WHERE login_id='" . $loginId . "';";
    $accountQueryResult = mysqli_query($dbAccess, $getAccountExistQuery);
    
    if($accountQueryResult->num_rows == 0) { 
        // 등록
        $addAccountQuery = "INSERT INTO `tb_members`(`type`, `login_id`, `login_password`, `status`) VALUES (" . $type .", '" . $loginId . "', '". $loginPassword . "', 1);";
        $accountQueryResult = mysqli_query($dbAccess, $addAccountQuery);
    }

    $getAccountQuery = "SELECT m.*, j.name FROM tb_members AS m LEFT JOIN tb_jobs AS j ON m.type = j.type WHERE m.status > 0;";
    $accountQueryResult = mysqli_query($dbAccess, $getAccountQuery);

    $tmp = array();
    if($accountQueryResult->num_rows > 0) {
        while($accountData = mysqli_fetch_assoc($accountQueryResult)) {
            array_push($tmp, $accountData);
        }
    }

    // p($accountQueryResult);

    $jsonResult["info"] = $tmp;

    mysqli_close($dbAccess);

    echo json_encode($jsonResult);
?>

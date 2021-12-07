<?php
    require "../../init.php";

    $post = $_POST;


    $loginId = empty($post["login_id"]) ? "test_id" : $post["login_id"];
    $loginPassword = empty($post["login_password"]) ? "1234" : $post["login_password"];

    

    #db connect
    $dbAccess = mysqli_connect("localhost", "han", $_LOCALPW, "study_db") or die("Connection Failed");

    $getAccountQuery = "SELECT count(*) as count FROM tb_members WHERE status > 0 AND login_id='" . $loginId . "';"; // res["cnt"];
    $accountQueryResult = mysqli_query($dbAccess, $getAccountQuery);

    if($accountQueryResult->num_rows > 0) {
        $accountData = mysqli_fetch_assoc($accountQueryResult); // 연관배열만 가지고 올 것. 일관배열은 unset 해야 함 => 일반, 연관 둘다 유니티에서 VO 만들어야 함
    }

    $accountModifyQuery = "INSERT INTO tb_members (login_id, login_password, status) ".
             "VALUES('" . $loginId ."', '" . $loginPassword . "', 1);";

    if($accountData["count"] > 0) {
        // 해당 아이디 존재
        $accountModifyQuery = "UPDATE tb_members SET login_pw='" . $loginPassword . "' WHERE login_id='" . $loginId . "';";
    }

    $accountModifyQueryResult = mysqli_query($dbAccess, $accountModifyQuery);




    mysqli_close($dbAccess);


?>
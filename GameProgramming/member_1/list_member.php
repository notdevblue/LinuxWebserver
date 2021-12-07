<?php
    require "../../init.php";

    #db connect
    $dbAccess = mysqli_connect("localhost", "han", $_LOCALPW, "study_db") or die("Connection Failed");

    $getAccountQuery = "SELECT count(*) as count FROM tb_members WHERE status > 0;"; // res["cnt"];
    $accountQueryResult = mysqli_query($dbAccess, $getAccountQuery);

    if($accountQueryResult->num_rows > 0) {
        $accountData = mysqli_fetch_assoc($accountQueryResult);
    }

    mysqli_close($dbAccess);

    // echo json_encode($asdf);
?>

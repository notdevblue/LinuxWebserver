<?php
    require "../../init.php";

    // login_id login_pw

    $post = $_POST;
    $loginId = $post["loginId"];

    $loginId = empty($post["loginId"]) ? "test_id" : $post["loginId"];
    $loginPassword = empty($post["loginPassword"]) ? "1234" : $post["loginPassword"];

    #db connect
    $dbo = mysqli_connect("localhost", "han", $_LOCALPW, "study_db");


?>
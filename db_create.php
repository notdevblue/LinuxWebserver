<?php
    require "init.php";

    $createquery = "
        CREATE TABLE tb_chars (
            `id` int NOT NULL AUTO_INCREMENT,
            `name` varchar(64) NOT NULL DEFAULT 'no_name',
            `reg_date` datetime NULL DEFAULT CURRENT_TIMESTAMP,
            primary key(id)
        );
    ";

    $insertquery ="
        insert into tb_chars (
            name
        ) values (
            'Han2'
        );
    ";

    $selectquery = "
        SELECT * FROM tb_chars
    ";

    $ret = db_query($selectquery);

    while($arr_ret = mysqli_fetch_array($ret))
    {
        p($arr_ret['name']);
    }

?>
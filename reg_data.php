<?php
    require "init.php";

    $table_name = "tb_Users";
    $dbo = mysqli_connect("localhost", "HanUseArch", $_PW, "project2");

    $query = "SELECT * FROM " . $table_name . " WHERE status > 0";
    $ret = mysqli_query($dbo, $query);

    $ret_array = array();
    if($ret !== false && $ret->num_rows > 0) // 데이터가 존재
    {
        while ($row = mysqli_fetch_array($ret)) {
            array_push($ret_array, $row);
        }
    }
    else // 데이터가 없음
    {
        $ret_select = "0 Result";
    }

?>
<HTML>

<Body>
    <Form method="POST" action="reg_process.php">
        UserID :
        <SELECT name="id">
            <Option value="0">신규 유저</OPtion>
            <?php
            foreach ($ret_array as $key => $val) {
            ?>
                <option value="<?php echo ($val["id"] . "_" . $val["count"])?>" ><?php echo $val["user_id"]?> </option>
            <?php
            }
            ?>
        </SELECT>
        <input type="submit" value="등록">
    </Form>
</BODY>

</HTML>
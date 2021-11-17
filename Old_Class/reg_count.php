<?php
    require "init.php";

    $db_name = "study_db";
    $table_name = "tb_Users";
    $dbo = mysqli_connect("localhost", "Han", "1234", "study_db") or die("connect fail!!");

    $select_table = "SELECT * FROM ";
    $select_table .= $db_name . "." . $table_name .";";

    $ret1 = mysqli_query($dbo, $select_table) or die ("Error select_table querying DB");

    $ret_row = array();
    if($ret1->num_rows > 0)
    {
        while($row = $ret1->fetch_assoc())
        {
            array_push($ret_row, $row);
        }
    }
    else
    {
        $ret_select = "0 results";
    }

    mysqli_close($dbo);

?>


<html>

<body>
    <form method="post" action="reg_count_proc.php">
        <table>
            <tr>
                <td>
                    <label for="id">UserID: </label>
                    <select name="id" id="id">
                        <option value="0" selected>-- 신규유저 --</option>
                        <?php
                        $count = 0;
                        foreach ($ret_row as $key => $val) {
                        ?>
                            <option value="<?php echo $val['id']; ?>">
                                <?php echo $val['user_id']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="submit" value="count" name=submit" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
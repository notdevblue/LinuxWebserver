<?PHP
    require "init.php";

    $db_name = "study_db";
    $table_name = "tb_Users";

    $insert_table = "INSERT INTO `" . $db_name . "`.`" . $table_name . "`(";
    $insert_table .= "`count`, `reg_Date`, `status`) ";
    $insert_table .= "VALUES (`1`, '" . date("Y-m-d H:i:s", time()) . "', '1')";

    $dbo = mysqli_connect("localhost", "Han", "1234", $db_name) or die("Connection failed.");
    $ret = mysqli_query($dbo, $insert_table) or die ("Error insert_table querying DB");

    $select_table = "SELECT * FROM " . $db_name . "." . $table_name . ";";
    $ret1 = mysqli_query($dbo, $select_table) or die("Error select_table querying DB");

    $ret_select;
    if($ret1->num_rows > 0)
    {
        while($row = $ret1->fetch_assoc())
        {
            $ret_select .= "id: " . $row["id"]. " - count: " . $row["count"] . " reg_date : " . $row["reg_date"] . "<br>";
        }
    }
    else
    {
        $ret_select = "0 results";
    }

    p($ret_select);
    mysqli_close($dbo);
?>
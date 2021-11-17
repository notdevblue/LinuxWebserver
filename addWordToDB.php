<?PHP
    require "init.php";

    $query = "

    ";


    $dbo = mysqli_connect("localhost", "HanUseArch", $_PW, "Class_10011");
    $ret = mysqli_query($dbo, $query) or die("Err querying DB");
    mysqli_close($dbo);


?>
<?php
// Packet Declaration
//     #TYPE#
//     $MEMBER
//     = this is value
//     ; <= packet end
//
//     example:
//         #TYPE#$A=wa sans$B=ori;#TYPE#$A=I'm ori$B=jemmun;
//         #LOGIN#$id=id$pw=pw;
//         #SCORE#$id=id$score=score;


require "./lib/lib.han.php"; // loop statement
require "../../lib/lib.common.php"; // debug only

$post = $_POST;

#region Null value check
$post["id"]     = empty($post["id"])     ? "no_id" : $post["id"];
$post["itemId"] = empty($post["itemId"]) ? -1      : $post["itemId"];
#endregion

$fetchResult = array(); // query data
$response = "";         // actual packet for client
$queryResult;           // actual query result
$row;                   // for fetch_row();
$dbAccess;
$i = 0;

#region Queries
$queryCheckUser      = "SELECT count(id) FORM `tb_gp` WHERE name='" . $post["id"] . "';";
$queryGetUserData    = "SELECT u.name, u.gold, i.name FROM tb_gp AS u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i ON m.itemId=i.id WHERE u.name='" . $post["id"] . "';";
$queryGetAllUserData = "SELECT u.name, u.gold, i.name FROM tb_gp AS u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i ON m.itemId=i.id;";
$queryGetHan         = "SELECT u.name, u.gold, i.name FROM tb_gp AS u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i ON m.itemId=i.id WHERE u.name='Han';";

$queryAddItemToUser  = "INSERT INTO itemMappingTable(charactorId, ItemId) VALUES (" . $post["id"] . ", " . $post["itemId"] . ");";
#endregion

$dbAccess    = mysqli_connect("localhost", "han", "1234", "study_db") or die("Cannot connect to database server.\r\nQuitting");
$queryResult = mysqli_query($dbAccess, $queryGetHan);


if ($queryResult) { // query result to array
    _while(function () {
        global $row;
        global $fetchResult;

        array_push($fetchResult, $row);
    }, function () {
        global $row;
        global $queryResult;

        return $row = mysqli_fetch_row($queryResult);
    });
    mysqli_free_result($queryResult);
}


$i = 0;
_repeat(count($fetchResult), function () { // array to string conversion (array to packet conversion)
    global $fetchResult;
    global $response;
    global $i;

    $response .= "#DATA#\$NAME=" . $fetchResult[$i][0] . "\$GOLD=" . $fetchResult[$i][1] . "\$WEAPON=" . $fetchResult[$i][2] . ";";
    ++$i;
});

echo $response;


mysqli_close($dbAccess);
?>
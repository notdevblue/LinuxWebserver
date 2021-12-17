<?php
// Packet Declaration
//     #TYPE#
//     $MEMBER
//     = this is value
//     & this is end of member       
//     ; <= packet end
//
//     example:
//         #TYPE#$A=wa sans$B=ori;#TYPE#$A=I'm ori$B=jemmun;
//         #LOGIN#$id=id$pw=pw;
//         #SCORE#$id=id$score=score;
ini_set("display_errors", 1);

require "./lib/lib.han.php"; // loop statement
require "../../lib/lib.common.php"; // debug only

$post = $_POST;


#region Null value check
// $post["type"] = "USERITEM";
if(empty($post["type"])) { // exception
    echo "#ERR#\$WHAT=No type found&;";
    exit();
}

$post["name"]   = empty($post["name"])   ? "no_id" : $post["name"];
$post["itemId"] = empty($post["itemId"]) ? "no_id" : $post["itemId"];
#endregion

$type = $post["type"];
$fetchResult = array(); // query data
$response = "";         // actual packet for client
$queryResult;           // actual query result
$row;                   // for fetch_row();
$dbAccess;
$i = 0;
$canBuy = false;

#region Queries
$queryCheckUser       = "SELECT count(id) FORM `tb_gp` WHERE name='" . $post["name"] . "';";
$queryGetUserData     = "SELECT u.name, u.gold, i.name FROM `tb_gp` AS u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i ON m.itemId=i.id WHERE u.name='" . $post["name"] . "';";
$queryGetAllUserData  = "SELECT u.name, u.gold         FROM `tb_gp` AS u;";
$queryGetHan          = "SELECT u.name, u.gold, i.name FROM `tb_gp` AS u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i ON m.itemId=i.id WHERE u.name='Han';";
$queryGetWeaponData   = "SELECT `name`, `price`  FROM `tb_item` WHERE `type`=0;";
$queryGetArmorData    = "SELECT `name`, `price`  FROM `tb_item` WHERE `type`=1;";
$queryGetUserItem     = "SELECT i.type, i.name   FROM tb_gp as u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i on m.itemId=i.id WHERE u.name='". $post["name"] ."';";
// $queryGetUserItem     = "SELECT i.type, i.name   FROM tb_gp as u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i on m.itemId=i.id WHERE u.name='오리';";
$queryCanBuyItem      = "SELECT id FROM `tb_item` WHERE `name`='" . $post["itemId"] . "' AND `price` <= (SELECT `gold` FROM `tb_gp` WHERE `name`='" . $post["name"] . "');";
// $queryCanBuyItem      = "SELECT COUNT(id) FROM `tb_item` WHERE `name`='신문지' AND `price` <= (SELECT `gold` FROM `tb_gp` WHERE `name`='오리');";
$queryAddItemToUser   = "INSERT INTO `tb_itemMappingTable` (`charactorId`, `ItemId`) VALUES ((SELECT `id` FROM `tb_gp` WHERE `name`='" . $post["name"] . "'), (SELECT `id` FROM `tb_item` WHERE `name`='" . $post["itemId"]. "'));";
$queryUpdateUserGold  = "UPDATE `tb_gp` SET `gold`=`gold`-(SELECT `price` FROM `tb_item` WHERE `name`='" . $post["itemId"] . "') WHERE `name`='". $post["name"] ."';";

#endregion

$dbAccess = mysqli_connect("localhost", "han", "1234", "study_db") or die("Cannot connect to database server.\r\nQuitting");

#region Query
switch($type)
{
    case "FULLDATA":
        $queryResult = mysqli_query($dbAccess, $queryGetAllUserData);
        break;

    case "DATA":
        $queryResult = mysqli_query($dbAccess, $queryGetUserData);
        break;
    
    case "GETARMOR":
        $queryResult = mysqli_query($dbAccess, $queryGetArmorData);
        break;
    
    case "GETWEAPON":
        $queryResult = mysqli_query($dbAccess, $queryGetWeaponData);
        break;

    case "USERITEM":
        $queryResult = mysqli_query($dbAccess, $queryGetUserItem);
        break;

    case "BUY":
        $queryResult = mysqli_query($dbAccess, $queryCanBuyItem);

        if(mysqli_fetch_row($queryResult) > 0) {
            mysqli_query($dbAccess, $queryAddItemToUser);
            mysqli_query($dbAccess, $queryUpdateUserGold);
            echo "#POPUP#\$TEXT=Successfully bought item.\$CALLBACK=RETURNTOMAIN&;";
        } else {
            echo "#POPUP#\$TEXT=Not enought gold.&;";
        }
        exit();
        break;

    default: // invalid $post["type"]
        echo "#ERR#\$WHAT=type is invalid&;";
        exit();

}
#endregion

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
    global $type;

    switch($type)
    {
        case "DATA":
        case "FULLDATA":
            // $response .= "#DATA#\$NAME=" . $fetchResult[$i][0] . "\$GOLD=" . $fetchResult[$i][1] . "\$WEAPON=" . $fetchResult[$i][2] . "&;";
            $response .= "#DATA#\$NAME=" . $fetchResult[$i][0] . "\$GOLD=" . $fetchResult[$i][1] . "&;";
            break;

        case "GETARMOR":
        case "GETWEAPON":
            $response .= "#WEAPONDATA#\$NAME=" . $fetchResult[$i][0] . "\$PRICE=" . $fetchResult[$i][1] . "&;";
            break;

        case "USERITEM":
            $response .= "#USERITEM#\$TYPE=" . $fetchResult[$i][0] . "\$NAME=" . $fetchResult[$i][1] . "&;";
            break;

        default:
            break;
    }

    ++$i;
});

echo $response;


mysqli_close($dbAccess);
?>
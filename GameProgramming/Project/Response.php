<!-- 
    #TYPE#
    $MEMBER
    = this is value
    ; <= packet end

    #TYPE#$A=wa sans$B=ori;
 -->

<?php
    $post = $_POST;

#region Queries
    $queryCheckUser      = "SELECT count(id) FORM `tb_gp` WHERE id=" . $post["id"];
    $queryGetUserData    = "SELECT * FROM tb_gp AS u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i ON m.itemId=i.id; WHERE u.id=" . $post["id"];
    $queryGetAllUserData = "SELECT * FROM tb_gp AS u LEFT JOIN tb_itemMappingTable AS m ON u.id=m.charactorId LEFT JOIN tb_item AS i ON m.itemId=i.id;";

    $queryAddItemToUser  = "INSERT INTO itemMappingTable(charactorId, ItemId) VALUES (". $post["id"] . ", " . $post["itemId"] . ");";
#endregion

    $response = array();

#region Exception
    if(empty($post["id"])) {
        echo "#ERR#\$WHAT=no id found;";
    }

#endregion

?>
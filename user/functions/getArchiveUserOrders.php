<?php
include_once dirname(__FILE__) ."/url.php";
error_reporting(0);


function getArchiveUserOrders($id)
{
    $url = getPath()."/API/order/getArchiveOrderUser.php?USER_ID=" . $id;
    if(($data = file_get_contents($url))!==false){
        return json_decode($data);
    }else{
        return false;
    }
}
?>
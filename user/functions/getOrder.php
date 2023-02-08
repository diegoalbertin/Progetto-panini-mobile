<?php
error_reporting(0);
include_once dirname(__FILE__) ."/url.php";

function getOrder($id)
{
    $url = getPath()."/API/order/getOrder.php?ID=" . $id;
    return json_decode(file_get_contents($url));
}
?>
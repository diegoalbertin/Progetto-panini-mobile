<?php
include_once dirname(__FILE__) ."/url.php";

function getOrderProducts($id)
{
    $url = getPath()."/API/order/getOrderProduct.php?ORDER_ID=" . $id;
    return json_decode(file_get_contents($url));
}
?>
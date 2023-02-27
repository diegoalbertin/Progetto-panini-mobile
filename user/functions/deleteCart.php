<?php
error_reporting(0);
include_once dirname(__FILE__) ."/url.php";

function deleteCart($user,$product)
{
    $url = getPath()."/API/cart/deleteItem.php?user=" . $user."&product=".$product;
    return json_decode(file_get_contents($url));
}
?>
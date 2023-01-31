<?php
include_once dirname(__FILE__) ."/url.php";
error_reporting(0);

function getCart($id)
{
    $url = getPath().'/API/cart/getCart.php?user='.$id;
    return json_decode(file_get_contents($url));
}

?>
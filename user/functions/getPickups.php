<?php 
include_once dirname(__FILE__) ."/url.php";

function getPickups()
{
    $url = getPath().'/API/order/pickup/getPickup.php';
    return json_decode(file_get_contents($url));
}

?>
<?php 
include_once dirname(__FILE__) ."/url.php";

function getBreakByPickup($id)
{
    $url = getPath().'/API/order/pickup/getPickupIdBreak.php?PICKUP_ID=' . $id;
    return json_decode(file_get_contents($url));
}

?>
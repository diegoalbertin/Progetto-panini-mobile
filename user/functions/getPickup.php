<?php
include_once dirname(__FILE__) ."/url.php";

function getPickup($id)
{
    $url = getPath()."/API/order/pickup/getPickupById.php?ID=" . $id;
    return json_decode(file_get_contents($url));
}
?>
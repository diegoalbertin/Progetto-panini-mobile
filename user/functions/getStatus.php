<?php
include_once dirname(__FILE__) ."/url.php";

function getStatus($id)
{
    $url = getPath()."/API/order/status/getStatus.php?STATUS_ID=" . $id;
    return json_decode(file_get_contents($url));
}
?>
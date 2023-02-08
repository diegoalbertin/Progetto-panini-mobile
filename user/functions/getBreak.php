<?php
include_once dirname(__FILE__) ."/url.php";

function getBreak($id)
{
    $url = getPath()."/API/order/break/getBreak.php?BREAK_ID=" . $id;
    return json_decode(file_get_contents($url));
}
?>
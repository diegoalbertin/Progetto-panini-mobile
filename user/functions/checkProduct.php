<?php
include_once dirname(__FILE__) ."/url.php";

function checkProduct()
{
    $url = getPath()."/API/product/checkProduct.php";
    return json_decode(file_get_contents($url));
}
?>
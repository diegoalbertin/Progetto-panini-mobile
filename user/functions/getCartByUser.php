<?php
include_once dirname(__FILE__) ."/url.php";

function getCartByUser($user)
{
    $url = getPath()."/API/cart/getCart.php?user=" . $user;
    return json_decode(file_get_contents($url));
}
?>
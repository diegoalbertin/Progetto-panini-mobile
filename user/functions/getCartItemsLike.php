<?php
include_once dirname(__FILE__) ."/url.php";

    function getCartItemsLike($user, $prod)
    {
        $prod = str_replace(" ", "+", $prod);
        $url = getPath()."/API/cart/getCartItemsLike.php?user=$user&product=$prod";   
        return json_decode(file_get_contents($url));
    }
?>
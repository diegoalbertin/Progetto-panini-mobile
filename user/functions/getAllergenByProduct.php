<?php
include_once dirname(__FILE__) ."/url.php";

function getAllergenByProduct($id)
{
    $url = getPath().'/API/product/getProductAllergen.php?PRODUCT_ID='.$id;
    return json_decode(file_get_contents($url));
}
?>
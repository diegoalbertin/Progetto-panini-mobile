<?php 
include_once dirname(__FILE__) ."/url.php";

function getProductIngredients($id)
{
    $url = getPath().'/API/product/getArchiveIngredients.php?panino=' . $id;
    return json_decode(file_get_contents($url));
}

?>
<?php
include_once dirname(__FILE__) ."/url.php";
$e=getActiveProductByTag(1);
var_dump($e);
function getActiveProductByTag($id)
{
    $url = getPath().'/API/product/getActiveProductByTag.php?TAG_ID='.$id;
    return json_decode(file_get_contents($url));
}
?>
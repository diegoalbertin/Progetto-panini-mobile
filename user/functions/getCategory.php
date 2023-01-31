<?php 
include_once dirname(__FILE__) ."/url.php";

function getcategory($id)
{
    $url = getPath().'/API/tag/getTag.php?tag_ID=' . $id;
    return json_decode(file_get_contents($url));
}

?>
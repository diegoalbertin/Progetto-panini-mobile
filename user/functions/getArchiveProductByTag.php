<?php
include_once dirname(__FILE__) ."/url.php";

function getArchiveProductByTag($id)
{
    $url = getPath().'/API/tag/product-tag/getArchiveProductTag.php?tag_id='.$id;
    return json_decode(file_get_contents($url));
}
?>
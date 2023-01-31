<?php
include_once dirname(__FILE__) ."/url.php";

function getCategories()
{
    $url = getPath().'/API/tag/getArchiveTag.php';
    return json_decode(file_get_contents($url));
}
?>
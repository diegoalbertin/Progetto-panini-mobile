<?php 
include_once dirname(__FILE__) ."/url.php";

function getUser($id)
{
    $url = getPath().'/API/user/getUser.php?id=' . $id;
    return json_decode(file_get_contents($url));
}

?>
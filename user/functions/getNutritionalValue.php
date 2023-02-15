<?php
include_once dirname(__FILE__) ."/url.php";

function getNutritionalValue($nutritionalValue_id)
{
    $url = getPath().'/API/nutritional_value/getNutritionalValue.php?NUTRITIONALVALUE_ID='.$nutritionalValue_id;
    return json_decode(file_get_contents($url));
}

?>
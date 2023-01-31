<?php
include_once dirname(__FILE__) ."/url.php";

    function getProductLikeWithTag($name, $tag_id)
    {
        $name = str_replace(" ", "+", $name);
        $url = getPath()."/API/product/getArchiveProductsLikeWithTag.php?nome_panino=$name&tag_id=$tag_id";
        return json_decode(file_get_contents($url), $assoc=true);
    }
?>
<?php   
include_once dirname(__FILE__) ."/url.php";

function updateCartQuantity($product, $user, $quantity)
{

    $url = getPath().'/API/cart/updateCartQuantity.php';
   
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url); // setta l'url
    curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa

    $headers = array(
        "Access-Control-Allow-Origin: *",
        "Access-Control-Allow-Methods: POST",
        "Access-Control-Max-Age: 3600",
        "Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With",
        "Content-Type: application/json; charset=UTF-8", 
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    $data = array(
        'user'=>$user,
        'product'=>$product,
        'quantity'=>$quantity
    );

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    curl_exec($curl);

    if ($e=curl_error($curl))
    {
        curl_close($curl);
    }
    else
    {
        curl_close($curl);
        return -1;
    }
}

?>
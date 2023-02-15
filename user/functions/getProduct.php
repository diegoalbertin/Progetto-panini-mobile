<?php
include_once dirname(__FILE__) ."/url.php";

function getProduct($id)
{
    $url = getPath().'/API/product/getProduct.php?PRODUCT_ID='.$id;
    $json_data = file_get_contents($url);

    $decode_data = json_decode($json_data, $assoc=true);
    $product_data = $decode_data;
    $product=array();
    foreach ($product_data as $prod) {
      $product_record= array(
        'id' => $prod["id"],
        'name' => $prod["name"],
        'price' => $prod["price"],
        'tag' => $prod["Tag"],
        'quantity' => $prod['quantity'],
        'description' =>$prod["description"],
        'nutritional_value'=> $prod["nutritional_value"]
    );
  array_push($product,$product_record);
  }
  return $product_record;
}
?>


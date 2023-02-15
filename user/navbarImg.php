<?php 
function switchImg ($url){
    if(str_contains($url,"index.php")==true){
        $imageLink=[
            "home"=>"static/img/home_filled.png",
            "profile"=>"static/img/user.png",
            "sandwich"=>"static/img/panini.png",
            "cart"=>"static/img/shopping-cart.png"
        ];
        return $imageLink;

    }else if(str_contains($url,"product.php")==true||str_contains($url,"category.php")==true||str_contains($url,"singleProduct.php")==true){
        $imageLink=[
            "home"=>"static/img/home.png",
            "profile"=>"static/img/user.png",
            "sandwich"=>"static/img/panini_filled.png",
            "cart"=>"static/img/shopping-cart.png"
        ];
        return $imageLink;

    }else if(str_contains($url,"profile.php")==true){
        $imageLink=[
            "home"=>"static/img/home.png",
            "profile"=>"static/img/user_filled.png",
            "sandwich"=>"static/img/panini.png",
            "cart"=>"static/img/shopping-cart.png"
        ];
        return $imageLink;

    }else if(str_contains($url,"cart.php")==true){
        $imageLink=[
            "home"=>"static/img/home.png",
            "profile"=>"static/img/user.png",
            "sandwich"=>"static/img/panini.png",
            "cart"=>"static/img/shopping-cart_filled.png"
        ];
        return $imageLink;

    }
}

?>
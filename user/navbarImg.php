<?php 
function switchImg ($url){
    if(str_contains($url,"index.php")==true){
        $imageLink=[
            "home"=>"static/img/home_filled.png",
            "profile"=>"static/img/user.png",
            "sandwich"=>"static/img/sandwich.png"
        ];
        return $imageLink;

    }else if(str_contains($url,"product.php")==true){
        $imageLink=[
            "home"=>"static/img/home.png",
            "profile"=>"static/img/user.png",
            "sandwich"=>"static/img/sandwich_filled.png"
        ];
        return $imageLink;

    }else if(str_contains($url,"profile.php")==true){
        $imageLink=[
            "home"=>"static/img/home.png",
            "profile"=>"static/img/user_filled.png",
            "sandwich"=>"static/img/sandwich.png"
        ];
        return $imageLink;

    }
}

?>
<?php 
include_once dirname(__DIR__) . '/user/functions/checkLogin.php';
include_once dirname(__DIR__) . '/user/functions/checkProduct.php';
include_once dirname(__DIR__) . '/user/functions/getCategories.php';

include_once dirname(__DIR__) . '/user/navbarImg.php';
session_start();
$user = checkLogin();

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$imageLink=switchImg($actual_link);
$categories=getCategories();

function getCategoryImg($categories, $categoryName){

    foreach($categories as $category){
        if(str_contains($categoryName,$category->name)==true){
            $path="static/img/$category->name.png";
            return $path;
        }
    }
    return "static/img/sandwich.png";
}
?>
<!DOCTYPE html>
<html>


    <head>
        <title>sandwech</title>
        <link rel="stylesheet" href="static/css/new.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="body">
        <div class="row">
            <div class="navbar-container">
                <div class="row">
                    <div class="navbar  col-6 offset-3">
                        <div class="icon-container col-4">
                            <a href="profile.php"><img class="navbar-icon" src=<?php echo $imageLink['profile'];?> alt="error"></a>
                        </div>
                        <div class="icon-container col-4">
                        <a href="index.php"><img class="navbar-icon" src=<?php echo $imageLink['home'];?> alt="error"></a>  
                        </div>
                        <div class="icon-container col-4">
                        <a href="category.php"><img class="navbar-icon" src=<?php echo $imageLink['sandwich'];?> alt="error"></a>        
                        </div>
                    </div>
                    <div class="navbar col-3">
                            <div class="icon-container col-4 offset-4">
                                <a href="cart.php"><img class="navbar-icon cart-icon" src=<?php echo $imageLink['cart'];?> alt="error"></a>        
                            </div>
                            <a class="logout col-4" href="functions/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="information-container text-center">
                <img src="static/img/app_logo.png" class="information-logo">
                <h1>Benvenuto <?php echo $user[0]->name;?></h1>
            </div>
        </div>
        <div class="row">
            <div class="form-container">
                <?php foreach($categories as $category){?>
                    <div class="row">
                        <a class="category" href="product.php?CATEGORY_ID=<?php echo $category->id; ?>">
                            <div class="category-div col-6 offset-3">
                                <div class="row">
                                    <div class="category-icon-div col-1">
                                        <img class="category-icon" src=<?php echo getCategoryImg($categories,$category->name);?> alt="">
                                    </div>
                                    <div class="category-name col-11">
                                        <h1><?php echo $category->name;?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                   <?php
                }?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
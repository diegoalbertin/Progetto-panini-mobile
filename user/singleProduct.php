<?php 
include_once dirname(__DIR__) . '/user/functions/checkLogin.php';
include_once dirname(__DIR__) . '/user/functions/getProduct.php';
include_once dirname(__DIR__) . '/user/functions/getNutritionalValue.php';
include_once dirname(__DIR__) . '/user/functions/setCart.php';
include_once dirname(__DIR__) . '/user/functions/getCartByUser.php';
include_once dirname(__DIR__) . '/user/functions/updateCartQuantity.php';
include_once dirname(__DIR__) . '/user/functions/getAllergenByProduct.php';
include_once dirname(__DIR__) . '/user/functions/getProductIngredient.php';

include_once dirname(__DIR__) . '/user/navbarImg.php';
session_start();
$user = checkLogin();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$imageLink=switchImg($actual_link);
$product_id= $_GET['PRODUCT_ID'];
$product = getProduct($product_id);
$allergens = getAllergenByProduct($product_id);
$ingredients = getProductIngredients($product_id);
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
            <div class="product-container">
                <div class="">
                <img src="static/img/panini.png" class="product-image">
                </div>
                <div class="product-name">
                    <h1 class="h1-product-name"><?php echo $product['name'];?></h1>
                </div>
                <div class="product-information">
                        <div class="row">
                            <button class="col-4 offset-4 rounded" onclick="hideShow()">aggiungi al carrello</button>
                        </div>
                        <div class="row">
                            <div class="addToCart col-6 offset-3 rounded" id="addToCart" style="display:none;">
                            <div class="row">
                                        <h3 class="" >Quantità (max <?php echo $product['quantity']?>):</h3>
                            </div>
                            <div class="row">
                                <button class="rounded col-2 offset-3" onclick="addProduct()">+</button>
                                <label class="txt-bold col-2" for="text" id="lblQuantity">1</label>
                                <button class="rounded col-2" onclick="minProduct()">-</button>
                            </div>
                            <div class="row">
                                <label class=" txt-bold col-2 offset-5" for="text" id="lblPrice"><?php echo $product['price'];?>€</label>
                            </div>
                                <form method="post">
                                    <div class="row">
                                        <input type="hidden" name="hidden-val" id="hidden-val" value="1">
                                    </div>
                                    <div class="row">
                                        <input class="col-4 offset-4 form-element rounded" type="submit"  name="addToCart-btn" value="aggiungi">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="product-description-price col-md-6">
                                <h3 class="">Prezzo: <?php echo $product['price'];?>€</h3>
                                <p class="product-description"><?php echo $product['description'];?></p>
                                <?php 
                                if($ingredients!=NULL){?>
                                    <h3 class="">Ingredienti:</h3>
                                    <?php foreach($ingredients as $ingredient)?>
                                    <p class="product-ingredient">-<?php echo $ingredient->name."\n";?></p>
                                <?php }?>
                                <?php 
                                if($allergens!=NULL){?>
                                    <h3 class="">Allergeni:</h3>
                                    <?php foreach($allergens as $allergen)?>
                                    <p class="product-allergen">-<?php echo $allergen->name."\n";?></p>
                                <?php }?>
                            </div>
                            <div class="product-nutritionalValues col-md-4 offset-md-1">
                                <?php 
                                    $nv=getNutritionalValue($product['nutritional_value']);
                                ?>
                                <table class="table table-hover table-responsive table-bordered table-sm border-dark">
                                    <thead class="primary">
                                        <th>valori medi</th>
                                        <th>per unità di prodotto
                                        </th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($nv[0] as $value=>$quantity){
                                            if($value!="id"){?>
                                        <tr>
                                        <th scope="row"><?php echo $value ;?></th>
                                        <td><?php echo $quantity ;?></td>
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addToCart-btn'])){
            $cartUser=getCartByUser(intval($_SESSION['user_id']));
            $cnt=true;
            foreach($cartUser as $cart){
                if(intval($cart->product)==intval($product['id'])){
                    $cnt=false;
                    updateCartQuantity(intval($product['id']),intval($_SESSION['user_id']),intval($_POST['hidden-val']));
                }
            }
            if($cnt===true){
                setCart(intval($product['id']),intval($_SESSION['user_id']),intval($_POST['hidden-val']));
            }
        }
        ?>
        <script>
            function getVal(){
                const elem = document.getElementById('hidden-val');
                const val = elem.value;
                return val;
            }
            function addProduct() {
                val=getVal();
                if(val < <?php echo $product['quantity'];?>){
                var newVal=parseInt(val) + 1;
                const elem = document.getElementById('hidden-val');
                elem.value =newVal;
                console.log(elem.value);
                const lblQuantity = document.getElementById('lblQuantity');
                lblQuantity.textContent=newVal;
                const lblPrice = document.getElementById('lblPrice');
                var price = newVal * parseFloat(<?php echo $product['price'];?>);
                lblPrice.textContent=price.toFixed(2).toString().concat("€");
                console.log();
            }}
            function minProduct(){
                val=getVal();
                if(val > 1){
                var newVal=parseInt(val) - 1;
                const elem = document.getElementById('hidden-val');
                elem.value =newVal;
                console.log(elem.value);
                const lblQuantity = document.getElementById('lblQuantity');
                lblQuantity.textContent=newVal;
                const lblPrice = document.getElementById('lblPrice');
                var price = newVal * parseFloat(<?php echo $product['price'];?>);
                lblPrice.textContent=price.toFixed(2).toString().concat("€");
                console.log();
                }
            }
            function hideShow(){
                const elem = document.getElementById('addToCart');
                console.log(elem.style.display);

                if(elem.style.display=='none!important'||elem.style.display=='none'){
                    elem.style.display='block';
                }else if(elem.style.display=='block'){
                    elem.style.display='none';  
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
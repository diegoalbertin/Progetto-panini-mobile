<?php
include_once dirname(__DIR__) . '/user/functions/checkLogin.php';
include_once dirname(__DIR__) . '/user/functions/getPickups.php';
include_once dirname(__DIR__) . '/user/functions/getPickup.php';
include_once dirname(__DIR__) . '/user/functions/getProduct.php';
include_once dirname(__DIR__) . '/user/functions/getCartByUser.php';
include_once dirname(__DIR__) . '/user/functions/updateCartQuantity.php';
include_once dirname(__DIR__) . '/user/navbarImg.php';
include_once dirname(__DIR__) . '/user/functions/deleteCart.php';


session_start();
$user = checkLogin();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$imageLink=switchImg($actual_link);
$cartUser=getCartByUser(intval($_SESSION['user_id']));
$pickups = getPickups();
function getTotalPrice($cart)
{
    $price = 0;
    foreach ($cart as $product)
    {
        $price += $product->price * $product->quantity;
    }

    return $price;
}

function getjsonProducts($cart)
{
    $json = array();
    foreach($cart as $product)
    {
        $formattedProd = array(
            'ID' => '' . $product->product . '',
            'quantity' => '' . $product->quantity . ''
        );
        $json[] = $formattedProd;
    }
    return $json;
}

function getJsonProductsForJson($cart)
{
    $json = array();
    foreach($cart as $product)
    {
        $formattedProd = array(
            'name' => '' . $product->name . '',
            'price' => '' . $product->price . '',
            'quantity' => '' . $product->quantity . ''
        );
        $json[] = $formattedProd;
    }
    return $json;
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>sandwech</title>
        <link rel="stylesheet" href="static/css/new.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="body" onload="totalPrice()">
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
            <?php foreach($cartUser as $cart){
                $product = getProduct($cart->product);?>
            <div class="cart-element text-center rounded col-10 offset-1">
                <div class="row"> 
                    <div class="col-1 ">
                        <div class="row full-height" >
                            <div class="middle-position">
                                <img class="cart-img" src="static/img/panini.png" class="information-logo">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <a  class="cart-prod-name" href="singleProduct.php?PRODUCT_ID=<?php echo $product['id'];?>"><h1><?php echo $product['name'];?></h1></a>
                    </div>
                    <div class="col-4 ">
                        <div class="row full-height" >
                            <div class="middle-position">
                                <button class=" rounded col-2 offset-3"  onclick="addProduct(<?php echo $product['id'];?>,<?php echo $product['price'];?>)">+</button>
                                <label class="txt-bold col-2" for="text" id="lblQuantity-<?php echo $product['id']; ?>"><?php echo intval($cart->quantity);?></label>
                                <button class="rounded col-2" onclick="minProduct(<?php echo $product['id']; ?>,<?php echo $product['price'];?>)">-</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row full-height" >
                            <div class="middle-position">
                                <label class="single-price txt-bold col-2 offset-5" for="text" id="lblPrice-<?php echo $product['id']; ?>"><?php echo intval($product['price'])*intval($cart->quantity);?>€</label>
                                <form method="post">
                                    <div class="row">
                                        <input type="hidden" class="" name="hidden-val" id="hidden-val-<?php echo $product['id']; ?>" value="<?php echo $cart->quantity;?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="row full-height" >
                            <div class="middle-position" style="justify-content:center;">
                                <form method="post">
                                    <input type="hidden" name="hidden-prod-id" value="<?php echo $product['id'];?>">
                                    <input class="rounded" type="submit" name="deleteProductFromCart" value="elimina">
                                </form>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <?php }?>
        </div>
        <div class="row">
            <div class="buy-container" id="parentDiv">
                <div class="table-line  col-10 offset-1"></div>
                <label class="form-element text-center txt-bold col-12" for="text" id="lblTotal" for="">Totale: </label>

                <div class=" dropdown text-center col-4 offset-4" id="dropBreak">
                <button class=" form-element btn btn-secondary dropdown-toggle" type="button" id="btnPickup" data-bs-toggle="dropdown" aria-expanded="false" value="PICKUP">
                    PICKUP
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <?php 
                        foreach($pickups as $pickup){ 
                            $singlePickup = getPickup($pickup->id);?>
                    <li><a class="dropdown-item" onclick="displayBreak(<?php echo $singlePickup[0]->id;?>,'<?php echo $singlePickup[0]->name;?>' )"><?php echo $singlePickup[0]->name;?></a></li>
                    <?php }?>
                </ul>
                </div>

                <div class=" dropdown text-center col-4 offset-4" id="dropBreak">
                <button class=" form-element btn btn-secondary dropdown-toggle"  type="button" id="btnBreak" data-bs-toggle="dropdown" aria-expanded="false" value="BREAK">
                    BREAK       
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="ulBreak" ></ul>
                </div>

                <form method="post">
                    <div class="row">
                        <input type="hidden" name="hidden-prod-id" value="<?php echo $product['id'];?>">
                        <input class="form-element col-4 offset-4 rounded" type="submit"  name="addToCart-btn" value="acquista" onclick='setOrder(<?php echo $_SESSION["user_id"] . "," .getTotalPrice($cartUser) . "," . json_encode(getjsonProducts($cartUser)) . "," . json_encode(getJsonProductsForJson($cartUser) . "," . json_encode($cartUser))?>)'>
                    </div>            
                </form>
            </div>
        </div>

        <?php 
        if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['deleteProductFromCart'])){
            deleteCart($_SESSION['user_id'],$_POST['hidden-prod-id']);
            echo"<script> window.location.href = 'cart.php'; </script>";
        }          
        ?>
        <script src="functions/url.js"></script>
        <script src="functions/order.js"></script>
        <script>
            function getVal(id){
                const elem = document.getElementById('hidden-val-'.concat(id));
                const val = elem.value;
                return val;
            }
            function addProduct(id,priceProd) {
                val=getVal(id);
                if(val < <?php echo $product['quantity'];?>){
                var newVal=parseInt(val) + 1;
                const elem = document.getElementById('hidden-val-'.concat(id));
                elem.value =newVal;
                const lblQuantity = document.getElementById('lblQuantity-'.concat(id));
                lblQuantity.textContent=newVal;
                const lblPrice = document.getElementById('lblPrice-'.concat(id));
                var price = newVal * parseFloat(priceProd);
                lblPrice.textContent=price.toFixed(2).toString().concat("€");
                totalPrice();
            }}
            function minProduct(id,priceProd){
                val=getVal(id);
                if(val > 1){
                var newVal=parseInt(val) - 1;
                const elem = document.getElementById('hidden-val-'.concat(id));
                elem.value =newVal;
                const lblQuantity = document.getElementById('lblQuantity-'.concat(id));
                lblQuantity.textContent=newVal;
                const lblPrice = document.getElementById('lblPrice-'.concat(id));
                var price = newVal * parseFloat(priceProd);
                lblPrice.textContent=price.toFixed(2).toString().concat("€");
                totalPrice();
                }
            }
            function totalPrice(){
                const elements = document.getElementsByClassName('single-price');
                var tot=0;
                for(var i = 0; i < elements.length; i++) {
                    tot = tot + parseInt(elements[i].textContent);
                }
                const lblTotal = document.getElementById('lblTotal');
                lblTotal.textContent='Totale: '.concat(tot.toFixed(2).toString().concat("€"));
            }

            function displayBreak(id,PickupName){
                const btnPickup = document.getElementById('btnPickup');
                btnPickup.innerText=PickupName;
                btnPickup.value=id;
                const parentDiv = document.getElementById('parentDiv');
                const ulBreak = document.getElementById('ulBreak');
                const liBreak = document.querySelectorAll('.liBreak');
                liBreak.forEach((liBreak) => liBreak.remove())

                fetch(getPath().concat('/API/order/pickup/getPickupIdBreak.php?PICKUP_ID='.concat(id)))
                .then(response => response.json())
                .then((data) => {
                data.forEach(bbreak => {

                    fetch(getPath().concat('/API/order/break/getBreak.php?BREAK_ID='.concat(bbreak['break'])))
                    .then((response => response.json()))
                    .then(data => {
                        const a = document.createElement("a");
                        a.className = "dropdown-item aBreak";
                        a.textContent = `${data[0]['time']}`;
                        a.value = bbreak['break'];
                        const li = document.createElement("li");
                        li.className = "liBreak";
                        li.onclick = function changeBreak(){
                                        const btnBreak = document.getElementById('btnBreak');
                                        btnBreak.innerText=`${data[0]['time']}`;
                                        btnBreak.value=bbreak['break'];

                                    };                       
                        li.appendChild(a);
                        ulBreak.appendChild(li);

                            })
                        });
                    })
            }
            function createOrder(){

            }


            </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
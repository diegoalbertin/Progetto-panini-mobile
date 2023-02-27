<?php
include_once dirname(__DIR__) . '/user/functions/checkLogin.php';
include_once dirname(__DIR__) . '/user/functions/getArchiveUserOrders.php';
include_once dirname(__DIR__) . '/user/functions/getPickup.php';
include_once dirname(__DIR__) . '/user/functions/getBreak.php';
include_once dirname(__DIR__) . '/user/functions/getStatus.php';
include_once dirname(__DIR__) . '/user/functions/getOrderProduct.php';
include_once dirname(__DIR__) . '/user/functions/getProduct.php';

include_once dirname(__DIR__) . '/user/navbarImg.php';

session_start();
$user = checkLogin();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$imageLink=switchImg($actual_link);
$archiveUserOrder=getArchiveUserOrders($_SESSION['user_id']);
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
            <?php if($archiveUserOrder!=NULL){ ?>
            <div class="archiveOrder-container col-10 offset-1">
                <h2>storico ordini</h2>
                <div class="row"></div><div class="table-line"></div></div>
            </div>  
                <?php foreach ($archiveUserOrder as $archiveOrder) {
                    if($archiveOrder!=NULL){
                    $pickup=getPickup($archiveOrder->pickup);
                    $break=getBreak($archiveOrder->break);
                    $status=getStatus($archiveOrder->status);
                    $productOrder=getOrderProducts($archiveOrder->id);
                ?>
            <div class="archiveOrder-container col-10 offset-1">

                            <table class="table table-hover table-responsive table-borderless">
                        <thead>
                            <tr>
                            <th scope="col">ID ordine</th>
                            <th scope="col">data/ora creazione</th>
                            <th scope="col">punto di ritiro</th>
                            <th scope="col">ricreazione</th>
                            <th scope="col">stato</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr class="table-line-bottom">
                            <th scope="row"><?php echo $archiveOrder->id;?></th>
                            <td><?php echo $archiveOrder->created;?></td>
                            <td><?php echo $pickup[0]->name;?></td>
                            <td><?php echo $break[0]->time;?></td>
                            <td><?php echo $status[0]->description;?></td>
                            </tr>
                        </tbody>
                        </table><table class="table table-hover table-responsive table-borderless">
                        <thead>
                            <tr>                            
                            <th class="" scope="row">prodotti ordinati:</th></tr></thead>
                            <tbody>
                                <?php foreach($productOrder as $productID){?>
                                    <tr>
                                    <td scope="row">
                                        <?php 
                                            $product = getProduct($productID->product);
                                            echo '<div class="row">';
                                            echo '<div class=" col-6"><p>-'.$product['name']."<p></div>";
                                            echo '<div class=" col-6"><p>quantità: '.$productID->quantity."<p></div>\n"; 
                                            echo '</div>';
                                        ?>
                                    </td></tr>
                                    <?php }?>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row"></div><div class="table-line"></div></div>
                        <?php }}?>

            </div>
            <?php } ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
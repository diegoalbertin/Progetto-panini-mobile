<?php
include_once dirname(__DIR__) . '/user/functions/checkLogin.php';
include_once dirname(__DIR__) . '/user/functions/logout.php';
include_once dirname(__DIR__) . '/user/navbarImg.php';

session_start();
$user = checkLogin();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$imageLink=switchImg($actual_link);
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
                            <a href="index.php"><img class="navbar-icon" src=<?php echo $imageLink['profile'];?> alt="error"></a>
                        </div>
                        <div class="icon-container col-4">
                        <a href="index.php"><img class="navbar-icon" src=<?php echo $imageLink['home'];?> alt="error"></a>  
                        </div>
                        <div class="icon-container col-4">
                        <a href="index.php"><img class="navbar-icon" src=<?php echo $imageLink['sandwich'];?> alt="error"></a>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="information-container text-center">
                <img src="static/img/app_logo.png" class="information-logo">
                <h1>CIAO, <?php echo $user[0]->name;?></h1>
            </div>
        </div>
    <form action="" method="POST">
        <input type="submit" name="logout" value="">
    </form>
    <?php if($_SERVER['REQUEST_METHOD']=='POST' ){
        logout();
        }?>
    </body>
    </html>
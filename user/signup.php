<?php 
include_once dirname(__FILE__) . '/functions/signup.php';
include_once dirname(__FILE__) . '/functions/login.php';

session_start();

$err = "";
$loginErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['sign-name']) && !empty($_POST['sign-surname']) && !empty($_POST['sign-email']) && !empty($_POST['sign-psw']) &&!empty($_POST['sign-psw-2'])) {
   if($_POST['sign-psw']==$_POST['sign-psw-2']){
    $data = [
    "name"=>$_POST['sign-name'],
    "surname"=>$_POST['sign-surname'],
    "email" => $_POST['sign-email'],
    "password" =>hash("sha256", $_POST['sign-psw']),
    ];
  
    if (signup($data) == -1)
    {
    $signupErr = "!! Email errata !!";
    }else{
    echo '<script>alert("utente creato")</script>';
    $loginData=[
        "email" =>$data['email'],
        "password" =>$data['password'],
    ];
    login($loginData);
    }
   }
   else{
    $err = "!! Password non corretta !!"; 
   }
  }
  else
  {
    $err = "!! Campi incompleti !!";
  }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="static/css/new.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="signup-container col-sm-10 offset-sm-1 col-md-6 offset-md-3 ">
            <div class="screen-1">
                <img src="static/img/app_logo.png" class="logo">
                <form class="form-signup" method="post" action="">
                    <h2>Signup</h2>
                    <span class="error-signup"><?php echo $err ?></span>
                    <div class="input-container">
                        <div class="element col-8 offset-2">
                        <label for="name">Nome</label>
                        <div class="sec-2 col-10 offset-1">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="text" name="sign-name" placeholder="nome" onkeypress="return isLetter(event)"><br>
                            <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                        </div>
                        </div><br>

                        <div class="element col-8 offset-2">
                        <label for="surname">Cognome</label>
                        <div class="sec-2 col-10 offset-1">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="text" name="sign-surname" placeholder="cognome" onkeypress="return isLetter(event)"><br>
                            <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                        </div>
                        </div><br>

                        <div class="element col-8 offset-2">
                        <label for="email">Email</label>
                        <div class="sec-2 col-10 offset-1">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="email" name="sign-email" placeholder="indirizo mail"><br>
                            <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                        </div>
                        </div><br>

                        <div class="element col-8 offset-2">
                        <label for="password">Password</label>
                        <div class="sec-2 col-10 offset-1">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="text" name="sign-psw" placeholder="············" ><br>
                            <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                        </div>
                        </div><br>

                        <div class="element col-8 offset-2">
                        <label for="password">Conferma Password</label>
                        <div class="sec-2 col-10 offset-1">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="text" name="sign-psw-2" placeholder="············"><br>
                            <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                        </div>
                        </div><br>

                        <input class="login" type="submit" value="sign up"><br>
                    </div>
                </form>
            </div>
        </div>
        <script>
        function isLetter(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode>=65 && charCode <=90)||(charCode>=97 && charCode <=122)) {
                return true;
            }
            return false;
        }
    </script>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>

<?php 

session_start();

include_once dirname(__FILE__) . '/functions/login.php';

$err = "";
$loginErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $data = [
      "email" => $_POST['email'],
      "password" =>hash("sha256", $_POST['password']),
    ];

    if (login($data) == -1)
    {
      $loginErr = "Email o password errata";
    }

  }
  else
  {
    $err = "Campo richiesto";
  }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" href="static/css/new.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="login-container  col-sm-10 offset-sm-1 col-md-6 offset-md-3">
          <div class="screen-1 h-50">
            <img src="static/img/app_logo.png" class="logo">
            <form  class="form-login" method="post">
            <h2>Login</h2>

              <span class="error-login"><?php echo $loginErr ?></span>
              <div class="input-container">
                <div class="element col-8 offset-2">
                <label for="email">Email Address</label>
                <div class="sec-2 col-10 offset-1">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" placeholder="Username@gmail.com" />
                </div>
                <span class="error-msg"><?php echo $err ?></span>
                </div><br>
                <div class="element col-8 offset-2">
                <label for="password">Password</label>
                <div class="sec-2 col-10 offset-1">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input class="pas" type="password" name="password" placeholder="············" />
                    <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                </div>
                <span class="error-msg"><?php echo $err ?></span>
                </div><br>
                <button class="login">Login</button>
                <div class="row">
                </div>

                </div>
              </form>
              <div class="row">
              <div class="footer">
                <span class="col-6"><a href="signup.php">Sign up</a></span>
                <span class="col-6"><a  href="index.php">Forgot Password?</a></spanS>
              </div>
            </div>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>

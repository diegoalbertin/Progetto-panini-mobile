<?php 

include_once dirname(__FILE__) . '/getUser.php';

function checkLogin()
{
    if (isset($_SESSION['user_id']))
    {

        $id = $_SESSION['user_id'];
        $user = getUser($id);
        return $user;
    }
    echo $_SESSION['user_id'];

    echo("no");

    header("Location: login.php");
}

?>
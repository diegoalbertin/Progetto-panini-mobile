<?php
function logout()
{
        unset($_SESSION['user_id']);

    header("Location: ../login.php");
}
logout();
?>
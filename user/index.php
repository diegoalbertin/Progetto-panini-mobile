<?php
include_once dirname(__DIR__) . '/user/functions/checkLogin.php';

session_start();

$user = checkLogin();
?>
<?php
include_once dirname(__DIR__) . '/functions/checkLogin.php';

session_start();

$user = checkLogin();
?>
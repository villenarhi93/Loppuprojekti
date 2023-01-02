<?php
require_once("./headers.php");

session_start();
require("./db_user_controller.php");

if (isset($_SESSION['username'])){
    http_response_code(200);
    echo "Hello ".$_SESSION['username'];
    return;
}

if (!isset($_POST['username']) || !isset($_POST['passwd'])){
    http_response_code(401);
    echo "Wrong username or password.";
    return;
}

$username = $_POST['username'];
$passwd = $_POST['passwd'];

$verified_user = checkUser($username, $passwd);

if ($verified_user){
    $_SESSION['username'] = $verified_user;
    http_response_code(200);
    echo "Hello ".$verified_user;
} else {
    http_response_code(401);
    echo "Wrong username or password.";
}
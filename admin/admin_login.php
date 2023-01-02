<?php
require('../inc/headers.php');
session_start();
require('../function/admin_controller.php');

if(isset($_SESSION['username'])){
    http_response_code(200);
    echo $_SESSION['username'];
    return;
}

if(!isset($_POST['aname']) || !isset($_POST['pw'])){
    http_response_code(401);
    echo "User not defined";
    return;
}

$aname = $_POST['aname'];
$pw = $_POST['pw'];

$verified_uname = checkAdmin($aname, $pw);

if($verified_uname) {
    $_SESSION["username"] = $verified_uname;
    http_response_code(200);
    echo $verified_uname;
} else {
    http_response_code(401);
    echo "Wrong username or password";
}
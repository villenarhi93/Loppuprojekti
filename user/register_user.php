<?php
require('../inc/headers.php');
session_start();
require('../function/user_controller.php');

$body = file_get_contents("php://input");
$user = json_decode($body);

if(!isset($user->uname) || !isset($user->pw)) {
    http_response_code(403);
    echo "User not defined. Give valid username and password";
    return;
}

 registerUser($user->uname, $user->pw);

 $_SESSION['username'] = $user->uname;

 http_response_code(200);
 echo "User ".$user->uname." registered";
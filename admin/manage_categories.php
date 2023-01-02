<?php

// Ylläpitoa varten tuoteryhmien selaus ja lisäämis osio

require ('../inc/functions.php');
require ('../inc/headers.php');

$input = json_decode(file_get_contents('php://input'));
$name = filter_var($input->name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
    $db = openDb();
    $sql = "INSERT INTO category (name) VALUES ('$name') ";
    executeInsert($db,$sql);
    $data = array('id'=> $db->lastInsertId(),'name'=>$name);
    print json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
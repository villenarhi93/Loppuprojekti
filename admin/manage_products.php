<?php

// Ylläpitoa varten tuotteiden selaus ja lisäys osio

require ('../inc/functions.php');
require ('../inc/headers.php');
require ('../dbconnection.php');

$input = json_decode(file_get_contents('php://input'));
$name = filter_var($input->name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$price = filter_var($input->price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$category_id = filter_var($input->categoryid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
    $db = openDb();
    $sql = "INSERT INTO product (name, price, image, category_id) VALUES ('$name','$price', NULL, $category_id)";
    executeInsert($db,$sql);
    $data = array('id'=> $db->lastInsertId(),'name'=> $name, 'price'=> $price, 'image'=> NULL);
    print json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
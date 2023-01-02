<?php

// Tuotteiden tilaaminen ostoskorista

require '../inc/functions.php';
require '../inc/headers.php';

$fname = filter_var($input->firstname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lname = filter_var($input->lastname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($input->email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$address = filter_var($input->address, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$zip = filter_var($input->zip, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$city = filter_var($input->city, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cart = $input->$cart;

try {
    $db = openDb();
    $db->beginTransaction();

    $sql = "INSERT INTO customer (firstname, lastname, address, zip, city) VALUES 
    ('".
    filter_var($fname, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
    filter_var($lname, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
    filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
    filter_var($address, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
    filter_var($zip, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" .
    filter_var($city, FILTER_SANITIZE_FULL_SPECIAL_CHARS) 
    . "')";

    $customer_id = executeInsert($db,$sql);

    $sql = "INSERT INTO order (customer_id) VALUES ($customer_id)";
    $order_id = executeInsert($db, $sql);

    foreach ($cart as $product) {
        $sql = "INSERT INTO order_row (order_id,product_id) VALUES ("
        .
        $order_id . "," .
        $product->$id
        . ")";
        executeInsert($db,$sql);
    }

    $db->commit();

    header('HTTP/1.1 200 OK');
    $data = array('id'=> $customer_id);
    echo json_encode($data);
    
} catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}
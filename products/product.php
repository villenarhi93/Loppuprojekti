<?php

// Tuotteen näyttäminen sivulla

require '../inc/functions.php';
require '../inc/headers.php';

$uri = parse_url(filter_input(INPUT_SERVER, 'PATH_INFO'), PHP_URL_PATH);
$parameters = explode('/', $uri);
$product_id = $parameters[1];

try {
    $db = openDb();
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $query = $db->query($sql);
    $product = $query->fetch(PDO::FETCH_ASSOC);
  
    header('HTTP/1.1 200 OK');
    echo json_encode(array("product" => $product));
    
  }
  catch (PDOException $pdoex) {
    returnError($pdoex);
  }
<?php

// Tuotteen etsiminen nimellä

require '../inc/functions.php';
require '../inc/headers.php';

$url = parse_url(filter_input(INPUT_SERVER, 'PATH_INFO'), PHP_URL_PATH);
$parameters = explode('/', $url);
$phrase = $parameters[1];

try {
    $db = openDb();
    $sql = "SELECT * FROM product WHERE name LIKE '%$phrase'";
    selectAsJson($db, $sql);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
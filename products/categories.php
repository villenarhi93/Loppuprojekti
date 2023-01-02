<?php

// Tuoteryhmien näyttäminen sivulla

require '../inc/functions.php';
require '../inc/headers.php';

try {
    $db = openDb();
    selectAsJson($db, 'SELECT * FROM category');
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
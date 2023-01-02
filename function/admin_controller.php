<?php
require('../dbconnection.php');    
    
function checkAdmin($aname, $pw) {
    $db = createSqliteConnection('../webshop.db');

    $sql = "SELECT passwd FROM admin WHERE username=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($aname));

    $hashedpw = $statement->fetchColumn();

    if(isset($hashedpw)){
        return password_verify($pw, $hashedpw) ? $aname : null; 
    }
    
    return null;
}

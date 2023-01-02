<?php
require_once('./functions.php');

function registerUser($uname, $pw){
    $db = openDb();

    $pw = password_hash($pw, PASSWORD_DEFAULT);

    $sql = "INSERT INTO kayttaja (käyttäjänimi, salasana) VALUES (?,?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname, $pw));
}

function checkUser($uname, $pw){
    $db = openDb();

    $sql = "SELECT salasana FROM kayttaja WHERE käyttäjänimi = ?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));

    $hash_pw = $statement->fetchColumn();

    if(isset($hash_pw)){
        return password_verify($pw, $hash_pw) ? $uname : null;
    }

    return null;
}

function getUserOrder($uname){
    $db = openDb();
}
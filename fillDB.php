<?php

/**
 * This script is meant to be run only once to fill the database with some data
 * You do not need to run it if you used the .sql file provided in the project folder
 * and imported it in your database via phpMyAdmin
 * 
 * This script is provided as an example of how to insert data in a database
 * (Note that this script does not use the DBModel class, but should have...)
 * 
 * @author: w.delamare
 * @date: Dec. 2023
 */


require_once "scripts/php/env_settings.php";     
$db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pwd, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Insert some data in the db
$request = "INSERT INTO user (firstname, lastname, login, password) VALUES (:first, :last, :login, MD5(:pwd))";
$statement = $db->prepare($request);
$statement->execute([
    "first" => "Homer",
    "last" => "Simpson",
    "login" => "donut",
    "pwd" => "123"
]);

$statement->execute([
    "first" => "Marge",
    "last" => "Simpson",
    "login" => "marge",
    "pwd" => "revelation"
]);

$statement->execute([
    "first" => "Bart",
    "last" => "Simpson",
    "login" => "el barto",
    "pwd" => "EatMyShorts"
]);

$statement->execute([
    "first" => "Lisa",
    "last" => "Simpson",
    "login" => "lisa_simpson",
    "pwd" => "Th*s_is_a_diffiCULT_pw8"
]);


// Simple code to check if the user exists
$request = "SELECT * FROM user WHERE login=:login and password = MD5(:pwd)";
$statement = $db->prepare($request);
$statement->execute(
    [
        "login" => "donut",
        "pwd" => "123"
    ]
);
$entries = $statement->fetchAll();
echo ("<pre>");
print_r($entries);
echo ("</pre>");

?>
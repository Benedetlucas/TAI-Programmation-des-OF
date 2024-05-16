<?php

// if we are in the local environment
$host = "localhost";
$dbname = "tai";
$user = "root";
$pwd = "";

// if we are on the server
if (file_exists("/var/www/")) {
    $host = "localhost";
    $dbname = "the-db-name";
    $user = "the-user";
    $pwd = "the-password";
}

?>
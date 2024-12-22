<?php


$db_host = "localhost";
$db_user = "root";
$db_pass = "kaua123";
$db_name = "api";

try {
    $dbh = new PDO('mysql:host=localhost;dbname=api;charset=utf8', $db_user, $db_pass);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
}
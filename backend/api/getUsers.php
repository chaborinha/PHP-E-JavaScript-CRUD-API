<?php
global $dbh;
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include "../database/db.php";

$users = [];
$stmt = $dbh->prepare("SELECT * FROM users");
$stmt->execute();
if ($stmt->rowCount() > 0){
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $users["empty"] = "empty";
}

echo json_encode($users);
<?php
global $dbh;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include '../database/db.php';

$inputs = file_get_contents("php://input");
$data = json_decode($inputs, true);

$sql = "INSERT INTO users (name, age, email, phone) VALUES (:name, :age, :email, :phone)";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':name', $data['name']);
$stmt->bindParam(':age', $data['age']);
$stmt->bindParam(':email', $data['email']);
$stmt->bindParam(':phone', $data['phone']);
if ($stmt->execute()) {
    echo json_encode(array("id" => $dbh->lastInsertId()));
} else {
    echo json_encode(array("error" => "Database error occured."));
}






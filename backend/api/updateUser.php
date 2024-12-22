<?php
global $dbh;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include '../database/db.php';

$inputs = file_get_contents("php://input");
$data = json_decode($inputs, true);

$query_update = "UPDATE users SET name = :name, age = :age, email = :email, phone = :phone WHERE id = :id";
$stmt = $dbh->prepare($query_update);
$stmt->bindParam(':name', $data['name_upd']);
$stmt->bindParam(':age', $data['age_upd']);
$stmt->bindParam(':email', $data['email_upd']);
$stmt->bindParam(':phone', $data['phone_upd']);
$stmt->bindParam(':id', $data['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user);
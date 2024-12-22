<?php
global $dbh;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include '../database/db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = [];
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if ($stmt->rowCount() > 0){
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $user["empty"] = "empty";
    }
    echo json_encode($user);
}
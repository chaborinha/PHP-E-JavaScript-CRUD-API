<?php

global $dbh;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include '../database/db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql_del = "DELETE FROM users WHERE id = :id";
    $stmt = $dbh->prepare($sql_del);
    $stmt->bindParam(':id', $id);
    if($stmt->execute()){
        echo json_encode(["success"=>true,"message"=>"User delete successfully"]);
    } else{
        echo json_encode(["success"=>true,"false"=>"server problem"]);
    }
}
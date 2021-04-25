<?php

$pdo = new PDO('mysql:hostname=localhost;dbname=vue-test', 'root', 'root', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$payload = json_decode(file_get_contents('php://input'));

$sth = $pdo->prepare(
    'insert into workers (name, department, phone, exp)
     values (:name, :department, :phone, :exp)'
);
$sth->execute([
    'name' => $payload->name,
    'department' => $payload->department,
    'phone' => $payload->phone,
    'exp' => $payload->exp,
]);


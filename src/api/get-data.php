<?php

$pdo = new PDO('mysql:hostname=localhost;dbname=vue-test', 'root', 'root', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$where = [];
$params = [];
if (!empty($_GET['name'])) {
    $where[] = "name = :name";
    $params['name'] = $_GET['name'];
}
if (!empty($_GET['department'])) {
    $where[] = "department = :department";
    $params['department'] = $_GET['department'];
}
if (!empty($_GET['phone'])) {
    $where[] = "phone = :phone";
    $params['phone'] = $_GET['phone'];
}
$sql = "select * from workers";
if (!empty($where)) {
    $sql .= ' where ' . implode(' and ', $where);
}

$sth = $pdo->prepare($sql);
$sth->execute($params);
$data = $sth->fetchAll();
echo json_encode($data, JSON_UNESCAPED_UNICODE);

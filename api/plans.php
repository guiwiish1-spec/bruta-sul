<?php

require "../vendor/autoload.php";

use Source\Core\Connection;

header("Content-Type: application/json");

$conn = Connection::getInstance();

$sql = $conn->query("SELECT * FROM plans");

echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
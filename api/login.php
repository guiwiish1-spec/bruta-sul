<?php

require "../vendor/autoload.php";

use Source\Models\User;

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    http_response_code(405);

    echo json_encode([
        "success" => false,
        "message" => "Método não permitido."
    ]);

    exit;
}

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$userModel = new User();

$user = $userModel->findByEmail($email);

if ($user && password_verify($password, $user["password"])) {

    unset($user["password"]);

    echo json_encode([
        "success" => true,
        "message" => "Login realizado com sucesso.",
        "user" => $user
    ]);

} else {

    http_response_code(401);

    echo json_encode([
        "success" => false,
        "message" => "E-mail ou senha incorretos."
    ]);
}
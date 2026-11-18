<?php

require "../vendor/autoload.php";

use Source\Models\User;

header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] != "POST"){

    http_response_code(405);

    echo json_encode([
        "success"=>false,
        "message"=>"Método não permitido."
    ]);

    exit;
}

$name = $_POST["name"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if(empty($name) || empty($email) || empty($password)){

    echo json_encode([
        "success"=>false,
        "message"=>"Preencha todos os campos."
    ]);

    exit;
}

$user = new User();

if($user->findByEmail($email)){

    echo json_encode([
        "success"=>false,
        "message"=>"E-mail já cadastrado."
    ]);

    exit;
}

$user->create($name,$email,$password);

echo json_encode([
    "success"=>true,
    "message"=>"Usuário cadastrado com sucesso."
]);
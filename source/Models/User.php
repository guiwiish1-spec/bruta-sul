<?php

namespace Source\Models;

use PDO;
use Source\Core\Connection;

class User
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function create(string $name, string $email, string $password): bool
    {
        $sql = $this->conn->prepare(
            'INSERT INTO users (typeId, name, email, password, photo)
             VALUES (:typeId, :name, :email, :password, NULL)'
        );

        return $sql->execute([
            'typeId' => 2,
            'name' => trim($name),
            'email' => strtolower(trim($email)),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    public function findByEmail(string $email): array|false
    {
        $sql = $this->conn->prepare(
            'SELECT users.*, user_types.name AS role
             FROM users
             INNER JOIN user_types ON users.typeId = user_types.id
             WHERE users.email = :email
             LIMIT 1'
        );
        $sql->execute(['email' => strtolower(trim($email))]);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}

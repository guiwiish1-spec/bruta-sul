<?php

namespace Source\Models;

use Source\Core\Connection;
use PDO;

class Teacher
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getTeachers(): array
    {
        $query = $this->conn->query("SELECT * FROM teachers ORDER BY name ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
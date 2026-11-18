<?php

namespace Source\Models;

use Source\Core\Connection;
use PDO;

class Plan
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getPlans(): array
    {
        $query = $this->conn->query("SELECT * FROM plans ORDER BY price ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
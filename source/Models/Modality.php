<?php

namespace Source\Models;

use Source\Core\Connection;
use PDO;

class Modality
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getModalities(): array
    {
        $query = $this->conn->query("SELECT * FROM modalities ORDER BY name ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
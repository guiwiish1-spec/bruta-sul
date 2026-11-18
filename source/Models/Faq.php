<?php

namespace Source\Models;

use Source\Core\Connection;
use PDO;

class Faq
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getFaqs(): array
    {
        $query = $this->conn->query("SELECT * FROM faqs ORDER BY id ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
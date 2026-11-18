<?php

namespace Source\Models;

use PDO;
use Source\Core\Connection;

class Schedule
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getSchedules(): array
    {
        $sql = 'SELECT schedules.*, modalities.name AS modality,
                       teachers.name AS teacher, teachers.specialty
                FROM schedules
                INNER JOIN modalities ON schedules.modality_id = modalities.id
                INNER JOIN teachers ON schedules.teacher_id = teachers.id
                ORDER BY FIELD(week_day, "Segunda-feira", "Terça-feira", "Quarta-feira",
                               "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"), hour';

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

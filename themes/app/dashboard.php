<?php

use Source\Models\Modality;
use Source\Models\Schedule;

$userName = $_SESSION['user']['name'] ?? 'aluno';
$modalityModel = new Modality();
$scheduleModel = new Schedule();
$modalities = $modalityModel->getModalities();
$schedules = $scheduleModel->getSchedules();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno | Bruta Sul Performance</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="app-page">
    <aside class="app-sidebar">
        <h2>Bruta Sul</h2>
        <nav>
            <a href="?page=app">Dashboard</a>
            <a href="?page=plan">Planos</a>
            <a href="?page=schedules">Horários</a>
            <a href="?page=modalities">Modalidades</a>
            <a href="?page=teachers">Professores</a>
            <a href="?page=logout">Sair</a>
        </nav>
    </aside>
    <main class="app-main">
        <header class="app-header">
            <div>
                <h1>Olá, <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?>!</h1>
                <p>Bem-vindo à sua área de treinos.</p>
            </div>
            <span class="app-user">Área do Aluno</span>
        </header>
        <section class="app-cards">
            <div class="app-card">
                <h3>Modalidades</h3>
                <p><?= count($modalities) ?></p>
                <span>modalidades disponíveis</span>
            </div>
            <div class="app-card">
                <h3>Horários</h3>
                <p><?= count($schedules) ?></p>
                <span>aulas cadastradas na grade</span>
            </div>
            <div class="app-card">
                <h3>Planos</h3>
                <p>Consulte</p>
                <span>as opções disponíveis</span>
            </div>
        </section>
        <section class="app-content">
            <div class="app-panel">
                <h2>Horários disponíveis</h2>
                <?php foreach (array_slice($schedules, 0, 5) as $schedule): ?>
                    <div class="schedule-item">
                        <strong><?= htmlspecialchars($schedule['modality'], ENT_QUOTES, 'UTF-8') ?></strong>
                        <span><?= htmlspecialchars($schedule['week_day'], ENT_QUOTES, 'UTF-8') ?> — <?= htmlspecialchars(substr($schedule['hour'], 0, 5), ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                <?php endforeach; ?>
                <p><a href="?page=schedules">Ver todos os horários</a></p>
            </div>
            <div class="app-panel">
                <h2>Modalidades</h2>
                <ul class="modality-list">
                    <?php foreach ($modalities as $modality): ?>
                        <li><?= htmlspecialchars($modality['name'], ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    </main>
    <script type="module" src="assets/js/app.js"></script>
</body>
</html>

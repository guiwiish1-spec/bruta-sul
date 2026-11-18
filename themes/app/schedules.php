<?php

use Source\Models\Schedule;

$scheduleModel = new Schedule();
$schedules = $scheduleModel->getSchedules();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horários | Bruta Sul</title>
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
        <div class="page-header">
            <h1>Horários disponíveis</h1>
            <p>Confira os dias, horários, modalidades e professores da academia.</p>
        </div>
        <div class="schedule-tools">
            <label for="schedule-search">Buscar aula</label>
            <input type="search" id="schedule-search" data-schedule-search placeholder="Buscar modalidade ou professor...">
            <p data-schedule-count aria-live="polite"></p>
        </div>
        <p data-schedule-empty hidden></p>
        <div class="schedule-grid" data-schedule-list>
            <?php if (!$schedules): ?>
                <p>Não há horários cadastrados no momento.</p>
            <?php else: ?>
                <?php foreach ($schedules as $schedule): ?>
                    <article class="schedule-card" data-schedule-card data-modality="<?= htmlspecialchars($schedule['modality'], ENT_QUOTES, 'UTF-8') ?>">
                        <h3><?= htmlspecialchars($schedule['modality'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($schedule['week_day'], ENT_QUOTES, 'UTF-8') ?></p>
                        <span><?= htmlspecialchars(substr($schedule['hour'], 0, 5), ENT_QUOTES, 'UTF-8') ?></span>
                        <p>Professor: <?= htmlspecialchars($schedule['teacher'], ENT_QUOTES, 'UTF-8') ?></p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    <script type="module" src="assets/js/app.js"></script>
</body>
</html>

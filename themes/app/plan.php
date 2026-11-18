<?php

use Source\Models\Plan;

$planModel = new Plan();
$plans = $planModel->getPlans();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planos | Bruta Sul</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="app-page">

    <aside class="app-sidebar">
        <h2>Bruta Sul</h2>

        <nav>
            <a href="?page=app">Dashboard</a>
            <a href="?page=plan">Meu Plano</a>
            <a href="?page=schedules">Horários</a>
            <a href="?page=modalities">Modalidades</a>
            <a href="?page=teachers">Professores</a>
            <a href="?page=logout">Sair</a>
        </nav>
    </aside>

    <main class="app-main">

        <div class="page-header">
            <h1>Planos disponíveis</h1>
            <p>Escolha o plano ideal para sua rotina de treinos.</p>
        </div>

        <div class="plan-grid">
            <?php foreach ($plans as $plan): ?>
                <div class="plan-card">
                    <h2><?= htmlspecialchars($plan["name"], ENT_QUOTES, "UTF-8") ?></h2>

                    <p><?= htmlspecialchars($plan["description"], ENT_QUOTES, "UTF-8") ?></p>

                    <span class="plan-price">
                        R$ <?= number_format($plan["price"], 2, ",", ".") ?>/mês
                    </span>
                </div>
            <?php endforeach; ?>
        </div>

    </main>

    <script type="module" src="assets/js/app.js"></script>
</body>
</html>
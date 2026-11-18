<?php

use Source\Models\Modality;

$modalityModel = new Modality();
$modalities = $modalityModel->getModalities();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modalidades | Bruta Sul</title>
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
            <h1>Modalidades</h1>
            <p>Conheça os treinos disponíveis na Bruta Sul Performance.</p>
        </div>

        <div class="modality-grid">

            <?php foreach ($modalities as $modality): ?>

                <div class="modality-card">
                    <h3><?= htmlspecialchars($modality["name"], ENT_QUOTES, "UTF-8") ?></h3>

                    <p>
                        <?= htmlspecialchars($modality["description"], ENT_QUOTES, "UTF-8") ?>
                    </p>
                </div>

            <?php endforeach; ?>

        </div>

    </main>

    <script type="module" src="assets/js/app.js"></script>
</body>
</html>
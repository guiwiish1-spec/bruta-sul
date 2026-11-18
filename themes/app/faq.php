<?php

use Source\Models\Faq;

$faqModel = new Faq();
$faqs = $faqModel->getFaqs();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ | Bruta Sul Performance</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="faq-page">

<div class="faq-container">

    <h1>Perguntas Frequentes</h1>
    <p>Tire suas principais dúvidas sobre a Bruta Sul Performance.</p>

    <?php foreach($faqs as $faq): ?>

        <details class="faq-item">

            <summary>
                <?= htmlspecialchars($faq["question"], ENT_QUOTES, "UTF-8") ?>
            </summary>

            <p>
                <?= nl2br(htmlspecialchars($faq["answer"], ENT_QUOTES, "UTF-8")) ?>
            </p>

        </details>

    <?php endforeach; ?>

    <div class="faq-buttons">
        <a href="?page=home">Voltar ao início</a>
    </div>

</div>

</body>
</html>
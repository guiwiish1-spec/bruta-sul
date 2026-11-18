<?php

use Source\Models\User;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($name === '' || $email === '' || $password === '' || $confirm === '') {
        $message = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Informe um e-mail válido.';
    } elseif (strlen($password) < 6) {
        $message = 'A senha deve ter pelo menos 6 caracteres.';
    } elseif ($password !== $confirm) {
        $message = 'As senhas não coincidem.';
    } else {
        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            $message = 'Este e-mail já está cadastrado.';
        } elseif ($userModel->create($name, $email, $password)) {
            header('Location: ?page=login&registered=1');
            exit;
        } else {
            $message = 'Não foi possível realizar o cadastro. Tente novamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta | Bruta Sul Performance</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
<main class="login-container">
    <section class="login-info">
        <h1>Comece sua<br>evolução</h1>
        <p>Crie sua conta na Bruta Sul Performance e tenha acesso aos planos, horários, modalidades e área do aluno.</p>
        <div class="login-tags"><span>Treinos</span><span>Lutas</span><span>Planos</span><span>Horários</span></div>
    </section>
    <section class="login-box">
        <h2>Criar conta</h2>
        <?php if ($message !== ''): ?><p class="login-error" role="alert"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <p class="login-subtitle">Cadastro de aluno</p>
        <form action="?page=register" method="POST">
            <label for="name">Nome completo</label>
            <input type="text" id="name" name="name" placeholder="Digite seu nome" required autocomplete="name">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required autocomplete="email">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Crie uma senha" required minlength="6" autocomplete="new-password">
            <label for="confirm_password">Confirmar senha</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Repita sua senha" required minlength="6" autocomplete="new-password">
            <button type="submit">Cadastrar</button>
        </form>
        <div class="login-links"><a href="?page=login">Já tenho conta</a><a href="?page=home">Voltar ao início</a></div>
    </section>
</main>
</body>
</html>

<?php

use Source\Models\User;

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Informe seu e-mail e sua senha.';
    } else {
        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: ?page=app');
            exit;
        }

        $error = 'E-mail ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bruta Sul Performance</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
<main class="login-container">
    <section class="login-info">
        <h1>Bruta Sul<br>Performance</h1>
        <p>Acesse sua área para acompanhar seus treinos, planos, horários e modalidades.</p>
        <div class="login-tags"><span>Musculação</span><span>Jiu-Jitsu</span><span>Boxe</span><span>Muay Thai</span><span>MMA</span></div>
    </section>
    <section class="login-box">
        <h2>Entrar na conta</h2>
        <?php if ($error !== ''): ?><p class="login-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <p class="login-subtitle">Área do aluno</p>
        <form action="?page=login" method="POST">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required autocomplete="email">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required autocomplete="current-password">
            <button type="submit">Entrar</button>
        </form>
        <div class="login-links"><a href="?page=register">Criar conta</a><a href="?page=home">Voltar ao início</a></div>
    </section>
</main>
</body>
</html>

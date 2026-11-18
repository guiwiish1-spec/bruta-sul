<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

$page = $_GET['page'] ?? 'home';

if ($page === 'logout') {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
    header('Location: ?page=home');
    exit;
}

$publicPages = ['home', 'login', 'register', 'faq'];
$appPages = ['app', 'schedules', 'teachers', 'modalities', 'plan'];

if (in_array($page, $appPages, true) && empty($_SESSION['user'])) {
    header('Location: ?page=login');
    exit;
}

$routes = [
    'home' => 'themes/site/home.php',
    'login' => 'themes/site/login.php',
    'register' => 'themes/site/register.php',
    'app' => 'themes/app/dashboard.php',
    'schedules' => 'themes/app/schedules.php',
    'teachers' => 'themes/app/teachers.php',
    'modalities' => 'themes/app/modalities.php',
    'plan' => 'themes/app/plan.php',
    'faq' => 'themes/app/faq.php',
];

require __DIR__ . '/' . ($routes[$page] ?? $routes['home']);

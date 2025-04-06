<?php
require_once '../bootstrap.php';
session_start();

// Load environment variables
$env = parse_ini_file('.env');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $env['ADMIN_USERNAME'] && $password === $env['ADMIN_PASSWORD']) {
        $_SESSION['authenticated'] = true;
        header('Location: scanner.php');
        exit;
    } else {
        $_SESSION['error'] = 'Username or password is incorrect.';
        header('Location: login.php');
        exit;
    }
}

header('Location: login.php');
exit;
?>
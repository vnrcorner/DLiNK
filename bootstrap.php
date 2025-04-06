<?php
define('BASE_PATH', dirname(__FILE__));
$env = parse_ini_file(BASE_PATH . '/config/.env');

if (!$env) {
    die('Error loading .env file');
}

foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
    putenv("$key=$value");
}
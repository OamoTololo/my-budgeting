<?php
use App\Core\Logger;

$config = require __DIR__ . '/config.php';

$logger = new Logger();

try {
    $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset=utf8mb4']}";

    $pdo = new PDO($dsn, $config['db']['user'], $config['db']['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $logger->info('Database Connection Successful');
} catch (PDOException $e) {
    $logger->error('Database Connection Failed: ' , ['error' => $e->getMessage()]);

    die("Database Connection Failed: " . $e->getMessage());
}

return $pdo;
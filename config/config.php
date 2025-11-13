<?php
// Database Connection

$dsn = 'mysql:host=localhost;dbname=myBudgeting;charset=utf8mb4';
$username = 'root';
$password = 'Tshimologo@23352433';

try {
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
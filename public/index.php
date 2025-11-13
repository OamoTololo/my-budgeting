<?php
use App\Core\Logger;

// Autoload all classes
require __DIR__ . '/../vendor/autoload.php';

// Initialize the logger
$logger = new Logger();
$logger->info("===  Application starting ===");

echo "<h1>Welcome to My Budgeting App</h1>";

$logger->info("Homepage displayed successfully.");
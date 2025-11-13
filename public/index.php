<?php
use App\Core\Logger;
use App\Controllers\HomeController;
use App\Controllers\AuthController;

// Enable strict typing and error displaying in development
declare(strict_types=1);
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// Autoload classes (we'll handle this manually)
spl_autoload_register(function (string $class) {
    $baseDir = __DIR__ . '/../app/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

$logger = new Logger();
$logger->info("=== Application Started ====");

// Simple Routing
$page = $_GET['page'] ?? 'home';

try {
    switch ($page) {
        case 'home':
            require __DIR__ . '/../app/Controllers/HomeController.php';
            $controller = new HomeController();
            $controller->index();
            break;

        case 'login':
            require __DIR__ . '/../app/Controllers/AuthController.php';
            $controller = new AuthController();
            $controller->login();
            break;

        default:
            $logger->warning("Page not found: " . $page);
            echo "404 - Page not found: " . $page;
    }
} catch (Throwable $e) {
    $logger->error("Unhandled Exception: ", ['error' => $e]);
    echo "An unknown error occurred. Please try again later.";
}
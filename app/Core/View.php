<?php

namespace App\Core;

class View
{
    protected Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger();
    }

    public function render(string $view, array $data = []): void
    {
        $viewFile = __DIR__ . "/../Views/{$view}.php";

        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;

            $this->logger->info("Rendered view", ['view' => $viewFile]);
        } else {
            $this->logger->info("View file not found", ['view' => $viewFile]);
            echo "View not found: $view";
        }
    }
}
<?php

namespace App\Core;

class Controller
{
    protected Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger();
    }

    /**
     * Load a view and pass data to it
     */
    public function view(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . "/../Views/$view.php";

        if (file_exists($viewPath)) {
            extract($data); // Make array keys available as variables in the view
            require $viewPath;
        } else {
            $this->logger->error("View file does not exist.", ['view' => $view]);
            echo "View $view not found.";
        }
    }

    /**
     * Load a model dynamically
     */
    public function model(string $model)
    {
        $modelPath = __DIR__ . "\\Models\\$model";

        if (file_exists($modelPath)) {
            return new $modelPath;
        } else {
            $this->logger->error("Model file does not exist.", ['model' => $model]);
            return null;
        }
    }
}
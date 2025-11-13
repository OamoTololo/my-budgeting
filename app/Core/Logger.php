<?php

namespace App\Core;

class Logger
{
    private string $logFile;

    public function __construct(string $logFile = __DIR__ . '/../../storage/logs/app.log')
    {
        $this->logFile = $logFile;

        // Make sure the logs directory exits
        $dir = dirname($logFile);

        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
    }

    /**
     * Write a log message with a level (INFO, WARNING, ERROR, etc.)
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = $context ? json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '';
        $logline = "[$timestamp] [$level] $message $contextStr" . PHP_EOL;

        file_put_contents($this->logFile, $logline, FILE_APPEND | LOCK_EX);

    }

    /** Convenience wrappers **/
    public function info(string $message, array $context = []): void
    {
        $this->log('INFO', $message, $context);
    }
    public function warning(string $message, array $context = []):void
    {
        $this->log('WARNING', $message, $context);
    }
    public function error(string $message, array $context = []): void
    {
        $this->log('ERROR', $message, $context);
    }
}
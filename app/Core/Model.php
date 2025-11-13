<?php

namespace App\Core;

use PDO;
use PDOException;
class Model
{
    protected PDO $db;
    protected Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger();
        $this->connect();
    }

    public function connect(): void
    {
        $config = require __DIR__ . "/../../config/config.php";

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4}";
            $this->db = new PDO($dsn, $config['user'], $config['pass']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->logger->info("Database connection established successfully in Model.");
        } catch (PDOException $e) {
            $this->logger->error("Database connection failed.", ['error' => $e->getMessage()]);
            die("Database connection failed.");
        }
    }

    /**
     * Generic query executor with prepared statements
     */
    public function query(string $sql, array $params = []): bool
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $this->logger->info("Query executed successfully.", ['query' => $sql, 'params' => $params]);

            return $stmt;
        } catch (PDOException $e) {
            $this->logger->error("Query failed.", ['query' => $sql, 'error' => $e->getMessage()]);

            return false;
        }
    }
}
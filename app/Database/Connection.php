<?php

namespace ContactsApp\Database;

use PDO;
use PDOException;

class Connection {
    /**
     * @var array $config  Array with database connection credentials.
     */
    private array $config;
    /**
     * @var PDO|null $conn  Connection object.
     */
    private ?PDO $conn;
    
    public function __construct() {
        $this->config = (require __DIR__ . "/../../config/config.php")["database"];
    }

    /**
     * Create and return a new database connection.
     * 
     * @return PDO|null PDO object or null if connection fails.
     */
    public function getConnection(): ?PDO {
        $this->conn = null;
        
        $dsn = "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']}";

        try {
            $this->conn = new PDO($dsn, $this->config["username"], $this->config["password"]);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Error during connection.";
            return null;
        }
    }
}

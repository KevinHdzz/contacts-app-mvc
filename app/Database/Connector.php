<?php

namespace ContactsApp\Database;

use PDO;
use PDOException;

class Connector {
    /**
     * @var array $config  Array with database connection credentials.
     */
    private array $config;
    /**
     * @var PDO|null $conn  Connection object.
     */
    private ?PDO $conn;
    
    public function __construct()
    {
        $this->config = (require __DIR__ . "/../../config/config.php")["database"];
    }

    /**
     * Create and return a new database connection.
     * 
     * @throws PDOException If the attempt to connect to the requested database fails.
     * 
     * @return PDO Connection object.
     */
    public function getConnection(): PDO
    {
        $this->conn = null;
        
        $dsn = "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']}";

        $this->conn = new PDO($dsn, $this->config["username"], $this->config["password"]);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $this->conn;
    }
}

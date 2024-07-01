<?php

namespace ContactsApp\Models;

use PDO;

/**
 * Abstract BaseModel class that defines basic methods for models interacting with the database.
 */
abstract class BaseModel {
    /**
     * @var string $table Name of the table in the database, defined in concrete classes.
     */
    protected static string $table;
    /**
     * @var PDO $conn PDO database connection object.
     */
    protected static PDO $conn;

    /**
     * @var int $id Model ID.
     */
    protected readonly int $id;

    /**
     * Sets the property id;
     * 
     * @param int $id
     * 
     * @return static The current instance.
     */
    protected function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }
    
    public function __get(string $name): mixed
    {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->$name = $value;
    }

    /**
     * Sets the database connection.
     * 
     * @param PDO $connection PDO connection instance.
     */
    public static function setConnection(PDO $connection): void
    {
        self::$conn = $connection;
    }

    /**
     * Finds model with the given ID.
     * 
     * @param int $id      ID of the model to find.
     * @return static|null The model instance or null if not found.
     * 
     * @throws PDOException On Error during database operation.
     */
    public static function find(int $id): ?static
    {
        $stmt = self::$conn->prepare("SELECT * FROM " . static::$table . " WHERE id = :id LIMIT 1");
        $stmt->execute([":id" => $id]);

        if ($stmt->rowCount() == 0) {
            return null;
        }

        return static::objFromRow($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Gets all models.
     * 
     * @return static[] An array of model instances.
     * 
     * @throws PDOException On Error during database operation.
     */
    public static function all(): array
    {
        $stmt = self::$conn->prepare("SELECT * FROM " . static::$table);
        $stmt->execute();
        
        $result = [];

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $result[] = static::objFromRow($row);
        }

        return $result;
    }

    /**
     * Deletes Model with the given id.
     * 
     * @param int $id ID of model to delete.
     * 
     * @throws PDOException On Error during database operation.
     */
    public static function delete(int $id): void
    {
        $stmt = self::$conn->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        $stmt->execute([":id" => $id]);
    }

    /**
     * Saves the current model in the database.
     * 
     * @return static The current instance.
     * 
     * @throws PDOException On Error during database operation.
     */
    abstract public function create(): static;

    /**
     * Updates the current model in the database.
     * 
     * @return static The current instance.
     * 
     * @throws PDOException On Error during database operation.
     */
    abstract public function update(): static;
    
    /**
     * Converts a database row to an object of the concrete class.
     *
     * @param array $row The database row.
     * 
     * @return static An object of the concrete class.
     */
    abstract protected static function objFromRow(array $row): static;
}

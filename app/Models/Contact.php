<?php

namespace ContactsApp\Models;

class Contact extends BaseModel {
    protected static string $table = "contacts";

    protected readonly int $id;
    protected string $name;
    protected string $phone;
    protected ?string $email;
    protected readonly int $userId;

    public function __construct(string $name, string $phone, ?string $email, int $userId)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->userId = $userId;
    }

    /**
     * Saves the current model in the database.
     * 
     * @return Contact The current instance.
     * 
     * @throws PDOException On Error during database operation.
     */
    public function create(): static
    {
        $table = self::$table;

        self::$conn
            ->prepare("INSERT INTO $table (name, phone, email, user_id) VALUE (:name, :phone, :email, :user_id)")
            ->execute([
                ":name" => $this->name,
                ":phone" => $this->phone,
                ":email" => $this->email,
                ":user_id" => $this->userId,
            ]);
        
        return $this;
    }

    /**
     * Updates the current model in the database.
     * 
     * @return User The current instance.
     * 
     * @throws PDOException On Error during database operation.
     */
    public function update(): static
    {
        $table = self::$table;

        self::$conn
            ->prepare("UPDATE $table SET name = :name, phone = :phone, email = :email WHERE id = :id")
            ->execute([
                ":name" => $this->name,
                ":phone" => $this->phone,
                ":email" => $this->email,
                ":id" => $this->id,
            ]);
         
        return $this;
    }

    /**
     * Converts a database row to an object of the concrete class.
     *
     * @param array $row The database row.
     * 
     * @return Contact An object of the concrete class.
     */
    protected static function objFromRow(array $row): static
    {
        return (
            new self($row["name"], $row["phone"], $row["email"], $row["user_id"])
        )->setId($row["id"]);
    }
}

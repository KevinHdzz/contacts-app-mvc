<?php

namespace ContactsApp\Models;

class User extends BaseModel {
    protected static string $table = "users";

    protected string $username;
    protected string $email;
    protected string $password;
    protected ?string $imgName;

    public function __construct(string $username, string $email, string $password, ?string $imgName)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->imgName = $imgName;
    }

    /**
     * Saves the current model in the database.
     * 
     * @return User The current instance.
     * 
     * @throws PDOException On Error during database operation.
     */
    public function create(): static
    {
        $table = self::$table;

        self::$conn
            ->prepare(
                "INSERT INTO $table (username, email, password, img_name) VALUES (:username, :email, :password, :img_name)"
            )->execute([
                ":username" => $this->username,
                ":email"    => $this->email,
                ":password" => $this->password,
                ":img_name" => $this->imgName,
            ]);

        return $this->setId(self::$conn->lastInsertId());
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
            ->prepare(
                "UPDATE $table SET username = :username, email = :email, password = :password, img_name = :img_name WHERE id = :id"
            )->execute([
                ":username" => $this->username,
                ":email"    => $this->email,
                ":password" => $this->password,
                ":img_name" => $this->imgName,
                ":id"       => $this->id,
            ]);

        return $this;
    }

    /**
     * Converts a database row to an object of the concrete class.
     *
     * @param array $row The database row.
     * 
     * @return User An object of the concrete class.
     */
    protected static function objFromRow(array $row): static
    {
        return (
            new self($row["username"], $row["email"], $row["password"], $row["img_name"])
        )->setId($row["id"]);
    }


    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function comparePassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}

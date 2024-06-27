<?php

namespace ContactsApp\Repositories\Impl;

use ContactsApp\Repositories\IUserRepository;
use ContactsApp\Models\User;
use ContactsApp\Models\UserId;
use PDO;

class UserRepository implements IUserRepository
{
    /**
     * @var PDO $conn Database connection object.
     * */
    private PDO $conn;
    /**
     * @var string $table Table name for users in database.
     * */
    private static string $table = "users";

    /**
     * Initialize the database connection object.
     * 
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->conn = $connection;
    }

    /**
     * List all users.
     * 
     * @return User[]
     */
    public function list(): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . self::$table);
        $stmt->execute();

        $users = [];
        
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $users[] = $this->userFromRecord($row);
        }

        return $users;
    }

    /**
     * Searches for a user by ID.
     * 
     * @param UserId $userId User ID.
     * 
     * @return User|null User object or null if not found.
     */
    public function search(UserId $userId): ?User
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . self::$table . " WHERE id = :id LIMIT 1");
        $stmt->execute([":id" => $userId->getValue()]);

        if ($stmt->rowCount() == 0) {
            return null;
        }
        
        return $this->userFromRecord($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create(User $user): void
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO " . self::$table . " (username, email, password, img_name)"
                . " VALUES (:username, :email, :password, :img_name)"
        );
        $stmt->execute([
            ":username" => $user->__get("username"),
            ":email"    => $user->__get("email"),
            ":password" => $user->__get("password"),
            ":img_name" => $user->__get("imgName"),
        ]);
    }

    public function update(User $user): void
    {
        $stmt = $this->conn->prepare(
            "UPDATE " . self::$table .
            " SET username = :username, email = :email, password = :password, img_name = :img_name" .
            " WHERE id = :id"
        );
        $stmt->execute([
            ":username" => $user->__get("username"),
            ":email"    => $user->__get("email"),
            ":password" => $user->__get("password"),
            ":img_name" => $user->__get("imgName"),
            ":id"       => $user->__get("id")->getValue(),
        ]);
    }

    private function userFromRecord(array $row): User
    {
        return (
            new User($row["username"], $row["email"], $row["password"], $row["img_name"]))
                ->setId(new UserId($row["id"])
        );
    }
}

<?php

require __DIR__ . "/../vendor/autoload.php";

\Dotenv\Dotenv::createImmutable(__DIR__ . "/..")->load();
$conn = (new \ContactsApp\Database\Connector())->getConnection();

try {
    if ($argv[1] == "-i") {
        $err_msg = "Error importing data";
        import($conn);
        echo "Data imported successfully." . PHP_EOL;
    } else if ($argv[1] == "-d") {
        $err_msg = "Error deleting data";
        delete($conn);
        echo "Data deleted successfully." . PHP_EOL;
    }
} catch (PDOException $e) {
    echo "$err_msg: {$e->getMessage()}";
}

/**
 * Imports data into the database.
 * 
 * @param PDO $conn  The PDO connection object.
 * @throws PDOException  On error during database operation.
 */
function import(PDO $conn): void {
    $users = require __DIR__ . "/users.php";
    $contacts = require __DIR__ . "/contacts.php";

    insert_multiple($users, "users", $conn);
    insert_multiple($contacts, "contacts", $conn);
}

/**
 * Inserts multiple rows into a specified table.
 * 
 * @param array<array<string, mixed>> $rows  The rows to insert.
 * @param string $table                      The table to insert the rows into.
 * @param PDO $conn                          The PDO connection object.
 * @throws PDOException  On error during database operation.
 */
function insert_multiple(array $rows, string $table, PDO $conn): void {
    $columns = array_keys($rows[0]);
    $placeholders = array_map(
        function (array $row): string {
            $aux = str_repeat("?, ", count($row));
            $result = substr($aux, 0, strlen($aux) - 2);

            return "($result)";
        },
        $rows
    );
    $values = array_merge(...array_map('array_values', $rows));

    $conn->prepare(
        "INSERT INTO $table (" . implode(", ", $columns) . ")" . " VALUES " . implode(", ", $placeholders)
    )->execute($values);
}

/**
 * Deletes all data from the users and contacts tables.
 * 
 * @param PDO $conn The PDO connection object.
 * 
 * @throws PDOException On error during database operation.
 */
function delete(PDO $conn): void {
    $conn->exec("DELETE FROM contacts");
    $conn->exec("DELETE FROM users");
}

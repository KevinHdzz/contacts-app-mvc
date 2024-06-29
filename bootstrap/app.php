<?php

use ContactsApp\Database\Connector;
use ContactsApp\Models\BaseModel;
use Dotenv\Dotenv;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

try {
    BaseModel::setConnection(
        (new Connector())->getConnection()
    );
} catch (PDOException $e) {
?>
    <!-- Test -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
    </head>
    <body>
        <h1>Oops! Something went wrong.</h1>
        <p>We are experiencing technical difficulties. Please try again later.</p>
    </body>
    </html>
<?php
    echo $e;
    exit();
}

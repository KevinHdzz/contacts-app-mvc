<?php

use ContactsApp\Database\Connection;
use ContactsApp\Models\BaseModel;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

// debug($_ENV);

BaseModel::setConnection(
    (new Connection())->getConnection()
);

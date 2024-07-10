<?php

return [
    "host" => $_ENV["DB_HOST"] ?? "127.0.0.1",
    "dbname" => $_ENV["DB_DATABASE"] ?? "contacts_app_mvc",
    "username" => $_ENV["DB_USERNAME"] ?? "root",
    "port" => $_ENV["DB_PORT"] ?? "3306",
    "password" => $_ENV["DB_PASSWORD"] ?? "",
];

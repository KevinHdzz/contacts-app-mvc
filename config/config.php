<?php

return [
    "database" => [
        "host" => $_ENV["DB_HOST"],
        "dbname" => $_ENV["DB_DATABASE"],
        "username" => $_ENV["DB_USERNAME"],
        "password" => $_ENV["DB_PASSWORD"],
        "port" => $_ENV["DB_PORT"],
    ],
    # some others settings...
];

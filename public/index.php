<?php

use ContactsApp\Database\Connection;
use ContactsApp\Http\HttpNotFoundException;
use ContactsApp\Models\BaseModel;
use ContactsApp\Models\Contact;
use ContactsApp\Models\User;
use ContactsApp\Routing\Router;

require "../vendor/autoload.php";

BaseModel::setConnection((new Connection())->getConnection());

debug(Router::$routes);

Router::get("/users", fn() => debug("users..."));
Router::get("/contacts", fn() => debug("contacts..."));
Router::get("/new-contact", fn() => debug("add new contact..."));
Router::post("/login", fn() => debug("login post..."));

debug(Router::$routes);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    debug($_GET);
}

echo "<br>";
try {
    Router::resolve();
} catch (HttpNotFoundException $e) {
    http_response_code(404);
    echo $e->getMessage();
}

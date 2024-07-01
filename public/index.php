<?php

use ContactsApp\Exceptions\HttpNotFoundException;
use ContactsApp\Routing\Router;
use ContactsApp\Controllers\HomeController;
use ContactsApp\Models\Contact;
use ContactsApp\Models\User;

require "../bootstrap/app.php";

Router::get("/", fn() => header("Location: /home"));
Router::get("/home", [HomeController::class, "home"]);

Router::get("/login", fn() => debug("Login..."));

try {
    Router::resolve();
} catch (HttpNotFoundException $e) {
    http_response_code(404);
    echo $e->getMessage();
}

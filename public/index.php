<?php

use ContactsApp\Http\HttpNotFoundException;
use ContactsApp\Routing\Router;
use ContactsApp\View\View;

require "../bootstrap/app.php";

Router::get("/", fn () => View::render(
    "home", ["message" => "Hello From Home"],
));

try {
    Router::resolve();
} catch (HttpNotFoundException $e) {
    http_response_code(404);
    echo $e->getMessage();
}

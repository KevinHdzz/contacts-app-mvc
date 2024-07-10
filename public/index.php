<?php

use ContactsApp\Controllers\ApiController;
use ContactsApp\Controllers\AuthController;
use ContactsApp\Exceptions\HttpNotFoundException;
use ContactsApp\Routing\Router;
use ContactsApp\Controllers\HomeController;
use ContactsApp\Models\User;

require "../bootstrap/app.php";

Router::get("/", fn () => header("Location: /home"));
Router::get("/home", [HomeController::class, "home"]);

Router::get("/register", [AuthController::class, "register"]);
Router::post("/register", [AuthController::class, "register"]);

Router::get("/login", [AuthController::class, "login"]);
Router::post("/login", [AuthController::class, "login"]);
Router::get("/logout", [AuthController::class, "logout"]);

Router::get("/api/contacts", [ApiController::class, "contacts"]);


Router::get("/test", function () {
    // View::render("test", [$title = "jlsd"]);
    debug(User::firstWhere("email", "totti@totti.com"));
});

// Router::get("/login", function () {
//     session_start();
//     debug($_SESSION);
//     debug("Login...");
// });

try {
    Router::resolve();
} catch (HttpNotFoundException $e) {
    http_response_code(404);
    echo $e->getMessage();
}

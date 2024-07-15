<?php

namespace ContactsApp\Controllers;

use ContactsApp\Helpers\FieldsValidator;
use ContactsApp\View\View;
use ContactsApp\Models\User;
use PDOException;

class AuthController {
    public static function register(): void
    {
        if (is_auth()) {
            header("Location: /home");
            exit();
        }
        
        $title = "Create Account";

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                View::render("auth/register", ["title" => $title]);
                break;
            
            case "POST":
                $data  = [
                    "username" => isset($_POST["username"]) ? trim($_POST["username"]) : "",
                    "email"    => isset($_POST["email"])    ? trim($_POST["email"])    : "",
                    "password" => isset($_POST["phone"])    ? trim($_POST["password"]) : "",
                ];

                $validator = new FieldsValidator($data);
                $validator->check("username")->notEmpty("Username is required");
                $validator->check("email")->notEmpty("Email is required")->isEmail("Invalid email");
                $validator->check("password")->notEmpty("Password is required")->hasLengthOf(["min" => 6], "Password must be at least 6 characters");

                if (!$validator->validFields()) {
                    View::render("auth/register", [
                        "title" => $title,
                        "errors" => $validator->firstErrors(),
                        "user" => [
                            "username" => $data["username"],
                            "email" => $data["email"],
                        ],
                    ]);
                    exit();
                }

                # The where and create methods can throw a PDOException
                try {
                    $errors = [];

                    if (User::exists("username", $data["username"])) {
                        $errors["username"] = "Username not available";
                    } else if (User::exists("email", $data["email"])) {
                        $errors["email"] = "This email is already registered";
                    }

                    if (count($errors) > 0) {
                        View::render("auth/register", [
                            "title" => $title,
                            "errors" => $errors,
                            "user" => [
                                "username" => $data["username"],
                                "email" => $data["email"],
                            ],
                        ]);
                        
                        exit();
                    }

                    // Register user in database
                    $user = new User($data["username"], $data["email"], $data["password"], null);
                    $user->hashPassword();
                    $user->create();

                    // authenticate user
                    session_start();

                    $_SESSION["user"] = [
                        "id" => $user->id,
                        "username" => $user->username,
                        "email" => $user->email,
                    ];

                    header("Location: /home");
                    exit();
                } catch (PDOException $e) {
                    exit("Upps something went wrong! Please try again later.");
                }
                break;
        }
    }

    public static function login(): void
    {
        if (is_auth()) {
            header("Location: /home");
            exit();
        }

        $title = "Login";

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                View::render("auth/login", ["title" => $title]);
                break;
            
            case "POST":
                $data = [
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                ];

                $validator = new FieldsValidator($data);
                $validator->check("email")->notEmpty("Email is required")->isEmail("Invalid Email");
                $validator->check("password")->notEmpty("Password is required");

                if (!$validator->validFields()) {
                    View::render("auth/login", [
                        "title" => $title,
                        "errors" => $validator->firstErrors(),
                        "user" => [
                            "email" => $data["email"]
                        ],
                    ]);

                    exit();
                }

                try {
                    $user = User::firstWhere("email", $data["email"]);
                } catch (PDOException $e) {
                    error_log($e->getMessage());
                    exit("Upss something went wrong! Please try again later.");
                }

                if (is_null($user) || !$user->comparePassword($data["password"])) {
                    View::render("auth/login", [
                        "title" => $title,
                        "errors" => ["Wrong email or password"],
                        "user" => ["email" => $data["email"]]
                    ]);
                    
                    exit();
                }
                
                session_start();

                $_SESSION["user"] = [
                    "id" => $user->id,
                    "username" => $user->username,
                    "email" => $user->email,
                ];

                header("Location: /home");
                exit();
        }
    }

    public static function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /");
        exit();
    }
}

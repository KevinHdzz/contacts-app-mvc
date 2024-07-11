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
            return;
        }
        
        $title = "Create Account";

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                View::render("auth/register", ["title" => $title]);     
                break;
            
            case "POST":
                $data  = [
                    "username" => trim($_POST["username"]),
                    "email" => trim($_POST["email"]),
                    "password" => trim($_POST["password"]),
                ];

                $validator = new FieldsValidator($data);
                $validator->check("username")->notEmpty("Username is required");
                $validator->check("email")->notEmpty("Email is required")->isEmail("Invalid email");
                $validator->check("password")->notEmpty("Password is required")->hasLengthOf(["min" => 6], "Password must be at least 6 characters");

                if (!$validator->validFields()) {
                    View::render("auth/register", [
                        "title" => $title,
                        "errors" => $validator->firstErrors(),
                        "values" => [
                            "username" => $data["username"],
                            "email" => $data["email"],
                        ],
                    ]);
                    
                    return;
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
                            "values" => [
                                "username" => $data["username"],
                                "email" => $data["email"],
                            ],
                        ]);
                        
                        return;
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
                    return;
                } catch (PDOException $e) {
                    echo "An error occurred during registration. Please try again later.";
                    return;
                }
        }
    }

    public static function login(): void
    {
        if (is_auth()) {
            header("Location: /home");
            return;
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
                        "values" => [
                            "email" => $data["email"]
                        ],
                    ]);

                    return;
                }

                try {
                    $user = User::firstWhere("email", $data["email"]);
                } catch (PDOException $e) {
                    println(values: "An error occurred while trying to log in. Please try again later.");
                    return;
                }

                if (is_null($user) || !$user->comparePassword($data["password"])) {
                    View::render("auth/login", [
                        "title" => $title,
                        "errors" => ["Wrong email or password"],
                        "values" => ["email" => $data["email"]]
                    ]);
                    
                    return;
                }
                
                session_start();

                $_SESSION["user"] = [
                    "id" => $user->id,
                    "username" => $user->username,
                    "email" => $user->email,
                ];

                header("Location: /home");
                return;
        }
    }

    public static function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /");
    }
}

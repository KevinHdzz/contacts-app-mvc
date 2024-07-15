<?php

namespace ContactsApp\Controllers;

use ContactsApp\Helpers\FieldsValidator;
use ContactsApp\View\View;
use ContactsApp\Models\Contact;
use PDOException;

class ContactsController {
    public static function create(): void
    {
        if (!is_auth()) {
            header("Location: /");
            exit();
        }

        $title = "New Contact";

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                View::render("contacts/create", ["title" => $title]);
                break;

            case "POST":
                $data = [
                    "name"  => isset($_POST["name"])  ? trim($_POST["name"]) : "",
                    "email" => isset($_POST["email"]) ? trim($_POST["email"]) : "",
                    "phone" => isset($_POST["phone"]) ? str_replace(" ", "", $_POST["phone"]) : "",
                ];

                $validator = new FieldsValidator($data);

                $validator->check("name")->notEmpty("Name is required");
                $validator->check("phone")
                    ->notEmpty("Phone is required")
                    ->isNumeric("Invalid phone number")
                    ->hasLengthOf(["min" => 10, "max" => 10], "Phone number must be 10 digits");
                if (!empty($data["email"])) {
                    $validator->check("email")->isEmail("Invalid email");
                }

                if (!$validator->validFields()) {
                    View::render("contacts/create", [
                        "title" => $title,
                        "errors" => $validator->firstErrors(),
                        "contact" => $data,
                    ]);
                    exit();
                }

                $contact = new Contact(
                    $data["name"], $data["phone"], !empty($data["email"]) ? $data["email"] : null, $_SESSION["user"]["id"] ?? 1,
                );

                try {
                    $contact->create();
                    header("Location: /home");
                    exit();
                } catch (PDOException $e) {
                    error_log($e->getMessage());
                    http_response_code(500);
                    exit("Upss something went wrong! Pleay try again later.");
                }

                break;
        }
    }

    public static function delete(): void
    {
        $id = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);

        if (!$id) {
            exit("Invalid request.");
        }

        try {
            if (!Contact::exists("id", $id)) {
                exit("Contact not found");
            }

            Contact::delete($id);

            header("Location: /home");
            exit();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            http_response_code(500);
            exit("Upss something went wrong! Please try again later.");
        }
    }
}

<?php

namespace ContactsApp\Controllers;

use ContactsApp\Models\Contact;
use ContactsApp\View\View;

class HomeController {
    public static function home(): void
    {
        if (!is_auth()) {
            header("Location: /login");
            return;
        }
        
        $contacts = Contact::all();

        View::render("home", [
            "title" => "Home",
            "contacts" => $contacts,
            "user" => $_SESSION["user"],
        ]);
    }
}

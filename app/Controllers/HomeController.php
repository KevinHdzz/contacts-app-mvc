<?php

namespace ContactsApp\Controllers;

use ContactsApp\Models\Contact;
use ContactsApp\View\View;

class HomeController {
    /**
     * Render home page for unauthenticated users.
     */
    public static function index(): void
    {
        if (is_auth()) {
            header("Location: /home");
            exit();
        }

        View::render("index");
    }
    
    /**
     * Render home page for authenticated users.
     */
    public static function home(): void
    {
        if (!is_auth()) {
            header("Location: /");
            exit();
        }
        // debug($_SESSION);
        
        $contacts = Contact::where("user_id", $_SESSION["user"]["id"]);

        View::render("home", [
            "title" => "Home",
            "contacts" => $contacts,
        ]);
    }
}

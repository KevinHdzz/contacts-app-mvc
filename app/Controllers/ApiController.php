<?php

namespace ContactsApp\Controllers;

use ContactsApp\Models\Contact;

class ApiController {
    public static function contacts(): void {
        $contacts = [];

        // session_start();
        // debug($_SESSION);

        foreach (Contact::all() as $contact) {
            $contacts[] = [
                "id" => $contact->__get("id"),
                "name" => $contact->__get("name"),
                "email" => $contact->__get("email"),
                "phone" => $contact->__get("phone"),
                "userId" => $contact->__get("userId"),
            ];
        }
        
        echo json_encode($contacts);
    }
}

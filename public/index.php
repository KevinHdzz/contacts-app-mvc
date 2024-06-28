<?php

use ContactsApp\Database\Connection;
use ContactsApp\Models\BaseModel;
use ContactsApp\Models\Contact;
use ContactsApp\Models\User;

require "../vendor/autoload.php";

BaseModel::setConnection((new Connection())->getConnection());


// test_contacts();
// test_users();

function test_users() {
    debug(User::all());
    // debug(User::find(-(-2)));

    $user = new User("Test", "test@test.com", "test123", null);
    // debug($user->create());

    $user = User::find(4);
    $user->__set("username", "Test last");
    $user->__set("email", "testlast@gmail.com");
    // debug($user->update());
}

function test_contacts(): void {
    $contact = new Contact("Test", "0394203", "test@gmail.com", 4);
    // debug($contact->create());
    $contact = Contact::find(3);
    debug($contact);
    // $contact->setId(43);
    // debug($contact);

    $contact->__set("name", "Danna");
    $contact->__set("phone", "555-2342");
    $contact->__set("email", "danna@danna.com");
    // $contact->__set("userId", 1); //error
    // debug($contact->update());
}

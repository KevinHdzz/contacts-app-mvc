<?php

use ContactsApp\Database\Connection;
use ContactsApp\Models\User;
use ContactsApp\Models\UserId;
use ContactsApp\Repositories\Impl\UserRepository;

require "utils/functions.php";
require __DIR__ . "/../vendor/autoload.php";

try {
    $userRepo = new UserRepository((new Connection())->getConnection());
} catch (PDOException $_) {
    exit("Error during database connection.");
}


debug($userRepo->list());
debug($userRepo->search(new UserId(2)));
debug($userRepo->search(new UserId(7)));
debug($userRepo->search(new \ContactsApp\Models\UserId(1)));

$user = new User("Roger", "roger@roger.com", "roger123", null);
var_dump($user->setId(new UserId(17)));
echo "{$user->__get("id")->getValue()}\n";
// $userRepo->create($user);

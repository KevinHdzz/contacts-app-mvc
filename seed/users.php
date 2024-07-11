<?php

$users = [
    [
        // id: 1
        "username" => "Kavinsito",
        "email" => "kavin@kavin.com",
        "password" => password_hash("kavin123", PASSWORD_BCRYPT),
        "img_name" => "randomimgname.jpg",
    ],
    [
        // id: 2
        "username" => "Danna",
        "email" => "danna@danna.com",
        "password" => password_hash("danna123", PASSWORD_BCRYPT),
        "img_name" => null,
    ],
    [
        // id: 3
        "username" => "Jhon",
        "email" => "jhon@gmail.com",
        "password" => password_hash("jhon123", PASSWORD_BCRYPT),
        "img_name" => "jhon_random_image.jpj",
    ],
    [
        // id: 4
        "username" => "David Hernández",
        "email" => "hdzdavid@gmail.com",
        "password" => password_hash("david123", PASSWORD_BCRYPT),
        "img_name" => null,
    ],
];

return $users;

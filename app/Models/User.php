<?php

namespace ContactsApp\Models;

class User {
    protected string $username;
    protected string $email;
    protected string $password;
    protected ?string $imgName;

    public function __construct(string $username, string $email, string $password, ?string $imgName)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->imgName = $imgName;
    }

    public function __get(string $name): mixed
    {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->$name = $value;
    }
}

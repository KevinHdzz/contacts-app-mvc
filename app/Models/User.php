<?php

namespace ContactsApp\Models;

class User {
    protected string $userName;
    protected string $email;
    protected string $password;
    protected ?string $imgName;

    public function __construct(string $userName, string $email, string $password, ?string $imgName)
    {
        $this->userName = $userName;
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

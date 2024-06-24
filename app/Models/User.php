<?php

namespace ContactsApp\Models;

class User {
    protected UserId $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected ?string $imgName;

    public function __construct(string $username, string $email, string $password, ?string $imgName) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->imgName = $imgName;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    public function setId(UserId $id): self {
        $this->id = $id;

        return $this;
    }
}

class UserId {
    protected int $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value;
    }
}

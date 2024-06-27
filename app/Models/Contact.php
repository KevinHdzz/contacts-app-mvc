<?php

namespace ContactsApp\Models;

class Contact {
    protected ContactId $id;
    protected string $name;
    protected string $phone;
    protected ?string $email;

    public function __construct(string $name, string $phone, ?string $email) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function __get(string $name): void {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    public function setId(ContactId $id): self {
        $this->id = $id;

        return $this;
    }
}

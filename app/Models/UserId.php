<?php

namespace ContactsApp\Models;

class UserId {
    protected int $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function getValue(): int {
        return $this->value;
    }
}

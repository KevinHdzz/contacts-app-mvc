<?php

namespace ContactsApp\Repository\Interfaces;

use ContactsApp\Models\User;
use ContactsApp\Models\UserId;

interface IUserRepository {
    public function search(UserId $userId): ?User;

    public function create(User $user): void;

    public function update(User $user): void;
}

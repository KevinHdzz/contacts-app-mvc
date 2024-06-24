<?php

namespace ContactsApp\Repositories;

use ContactsApp\Models\Contact;
use ContactsApp\Models\ContactId;
use ContactsApp\Models\UserId;

interface IContactRepository {
    public function allOf(UserId $userId): array;

    public function search(ContactId $contactId): ?Contact;

    public function create(Contact $contact): void;

    public function update(Contact $contact): void;

    public function delete(ContactId $contactId): void;
}

<?php

namespace ContactsApp\Http;

use Exception;

class HttpNotFoundException extends Exception
{
    public function __construct(string $message = "HTTP 404 NOT FOUND.")
    {
        parent::__construct($message);
    }
}

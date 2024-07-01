<?php

function is_auth(): bool {
    session_start();
    
    return isset($_SESSION["user"]);
}

function debug(mixed $value, ...$values) {
    echo "<pre>";
    var_dump($value, ...$values);
    echo "</pre>";
}

function println(string $end = "<br>", ... $values): void {
    foreach ($values as $value):
        echo "$value$end";
    endforeach;
}

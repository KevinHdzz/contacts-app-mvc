<?php

function is_auth(): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION["user"])) {
        session_destroy();
        return false;
    }

    return true;
}

function is_assoc(array $array): bool {
    if (empty($array)) {
        return false;
    }

    $keys = array_keys($array);

    return array_keys($keys) !== $keys;
}

function debug(mixed $value, ...$values): void {
    echo "<pre>";
    var_dump($value, ...$values);
    echo "</pre>";
}

function println(string $end = "<br>", ...$values): void {
    foreach ($values as $value):
        echo "$value$end";
    endforeach;
}

function sanitize_input(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function load_scripts(array $route_scripts): void {
    foreach ($route_scripts as $path => $scripts) {
        if ($_SERVER["PATH_INFO"] == $path) {
            echo implode("", $scripts);
        }
    }
}

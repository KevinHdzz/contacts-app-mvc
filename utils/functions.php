<?php

function is_auth(): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    return isset($_SESSION["user"]);
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

function load_scripts(array $route_scripts): void {
    foreach ($route_scripts as $path => $scripts) {
        if ($_SERVER["PATH_INFO"] ?? "/" == $path) {
            echo implode("", $scripts);
        }
    }
}

// 231 208 1991

function format_phone_number(string $phone): string {
    $formatted = str_split(str_replace(" ", "", $phone));
    array_splice($formatted, 3, 0, [" "]);
    array_splice($formatted, 7, 0, [" "]);

    return implode($formatted);
}

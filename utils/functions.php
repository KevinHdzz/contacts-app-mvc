<?php

function debug(mixed $value, ...$values) {
    echo "<pre>";
    var_dump($value, ...$values);
    echo "</pre>";
}

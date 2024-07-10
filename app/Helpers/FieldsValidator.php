<?php

namespace ContactsApp\Helpers;

class FieldsValidator {
    /** @var array<string, mixed> $array  Array that will be validated. */
    private array $array;
    /** @var array<string, string[]> $errors  Contains invalid fields with their corresponding error messages. */
    private array $errors;
    /** @var string $currentField  The `$array` field that is currently being validated. */
    private string $currentField;

    /**
     * Initialize the array with the fields to validate.
     * 
     * @param array<string, mixed> $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
        $this->errors = [];
    }

    /**
     * Check if all fields are valid.
     * 
     * @return bool  Returns true if all fields are valid, false otherwise.
     */
    public function validFields(): bool
    {
        foreach ($this->errors as $errors) {
            if (count($errors) > 0) return false;
        }
        
        return true;
    }

    /**
     * Get all validation errors.
     * 
     * @return array<string, string[]>  An associative array of fields and their corresponding error messages.
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Get only the first error message for each field.
     * 
     * @example: `$this->errors = [
     *    "username" => ["Username is required"],
     *    "email" => ["Email is required", "Invalid email"]
     *  ];`
     * 
     *  `$firstErrors = $this->firstErrors();`
     *   $fieldErrors will be:
     *  `[
     *    "username" => "Username is require",
     *    "email" => "Email is required",
     *  ]`
     * 
     * @return array<string, string>  An associative array of fields and their first error messages.
     */
    public function firstErrors(): array
    {
        return array_map(fn (array $fieldErrors) => $fieldErrors[0], $this->errors);
    }

    /**
     * Set the field to be validated.
     * 
     * @param string $field  The name of the field to validate.
     * @return self          The current instance.
     */
    public function check(string $field): self
    {
        $this->currentField = $field;

        return $this;
    }

    /**
     * Validate that the current field is not empty.
     * 
     * @param string $message [Optional]  The error message to use if the validation fails.
     * @return self                       The current instance.
     */
    public function notEmpty(string $message = ""): self
    {
        if (empty($this->array[$this->currentField])) {
            $this->errors[$this->currentField][] = $message;
        }

        return $this;
    }

    /**
     * Validate that the current field is a valid email.
     * 
     * @param string $message The error message to use if the validation fails.
     * @return self           The current instance.
     */
    public function isEmail(string $message = ""): self
    {
        if (!filter_var($this->array[$this->currentField], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->currentField][] = $message;
        }

        return $this;
    }

    /**
     * Validate the length of the current field.
     * 
     * @param array<string, int> $length  An array with `min` and/or `max` keys specifying the length constraints.
     * @param string $message             The error message to use if the validation fails.
     * @return self                       The current instance.
     */
    public function hasLengthOf(array $length = ["min" => 0, "max" => PHP_INT_MAX], string $message = ""): self
    {
        $length["min"] = $length["min"] ?? 0;
        $length["max"] = $length["max"] ?? PHP_INT_MAX;
        
        if (
            strlen($this->array[$this->currentField]) < $length["min"] ||
            strlen($this->array[$this->currentField]) > $length["max"]
        ) {
            $this->errors[$this->currentField][] = $message;
        }

        return $this;
    }
}

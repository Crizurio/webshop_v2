<?php

namespace webshop_v2\Validators;

abstract class FieldValidator
{
    protected $error_message = '';

    abstract public function validate (
        \webshop_v2\Fields\BaseField $field): bool;

    public function getError() : string
    {
        return $this->error_message;
    }
}
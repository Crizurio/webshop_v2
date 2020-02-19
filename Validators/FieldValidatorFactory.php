<?php

//TODO test of namespace klopt

namespace webshop_v2\Validators;

class FieldValidatorFactory
{
    public function getFieldValidator(string $type)
    {
        switch($type)
        {
            case 'email':
                return new \webshop_v2\Validators\EmailValidator;

            default:
                return new \webshop_v2\Validators\GenericValidator;
        }
    }
}
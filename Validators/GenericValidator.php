<?php

namespace webshop_v2\Validators;

class GenericValidator extends FieldValidator
{
    public function validate(\webshop_v2\Fields\BaseField $field) : bool
    {
        $password_regex = '/[a-zA-Z0-9_. -]+/';
        if (!preg_match($password_regex, $field->getValue()))
        {
            $this->error_message = 
                'This field should consist of alpha numeric characters. 
                 Please try again.';

            return false;
        }

        return true;
    }
}
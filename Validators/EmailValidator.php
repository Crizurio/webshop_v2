<?php

namespace webshop_v2\Validators;

class EmailValidator extends FieldValidator
{
    public function validate(\webshop_v2\Fields\BaseField $field): bool
    {
        $email_regex = '/^\w+@\w+\.\w+$/';
        $field_value = $field->getValue();
        if (!$field_value == NULL)
        {
            if (!preg_match($email_regex, $field_value))
            {
                $this->error_message = 'Invalid Email';
                return false;
            }

            return true;
        }

        return false;
    }
}
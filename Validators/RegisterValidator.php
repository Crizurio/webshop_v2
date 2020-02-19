<?php

namespace webshop_v2\Validators;

use webshop_v2\Interfaces\iValidators as iValidators;

class RegisterValidator implements iValidators\iFormValidator
{
    const EMAIL_VALIDATOR_ERROR = 'Email already exists.';
    const PASSWORD_INVALID = 'Your password are not equal.';

    public function __construct(
        \webshop_v2\Models\UserModel $user_model,
        \webshop_v2\Fields\FieldCollection $field_collection
    )

    {
        $this->user_model = $user_model;
        $this->field_collection = $field_collection;
    }

    public function validateCredentials(): bool
    {
        $email = $this->field_collection->getFieldByName('email')
            ->getValue();
        $password1 = $this->field_collection->getFieldByName('password')
            ->getValue();
        $password2 = $this->field_collection->getFieldByName('password2')
            ->getValue();

        $user = $this->user_model->getUserByEmail($email);
        if ($user)
        {
            $this->field_collection->getFieldByName('email')
                 ->setError(self::EMAIL_VALIDATOR_ERROR);
            return false;
        }
        var_dump($password1);
        var_dump($password2);
        if(!($password1 === $password2))
        {
            $this->field_collection->getFieldByName('password')
                 ->setError(self::PASSWORD_INVALID);
            return false;
        }

        return true;
    }
}
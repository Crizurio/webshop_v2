<?php

namespace webshop_v2\Validators;

use webshop_v2\Interfaces\iValidators as iValidators;
use webshop_v2\Models as Models;
use webshop_v2\Fields as Fields;

class LoginValidator implements iValidators\iFormValidator
{
    const EMAIL_VALIDATOR_ERROR = 'Invalid email address';
    const PASSWORD_INVALID = 'Invalid password';

    public function __construct(
        Models\UserModel $user_model,
        Fields\FieldCollection $field_collection
    )

    {
        $this->user_model = $user_model;
        $this->field_collection = $field_collection;
    }

    public function validateCredentials(): bool
    {
        $email = $this->field_collection->getFieldByName('email')->getValue();
        $password = $this->field_collection->getFieldByName('password')->getValue();
        
        if (!$this->user_model->getUserByEmail($email))
        {
            
            $this->field_collection
                 ->getFieldByName('email')->setError(self::EMAIL_VALIDATOR_ERROR);
            return false;
        }

        if (!password_verify($password,
             $this->user_model->getUserByEmail($email)['password']))
        {
            $this->field_collection->getFieldByName('password')->setError(
                self::PASSWORD_INVALID); 
            return false;           
        }

        return true;
            
    }
}
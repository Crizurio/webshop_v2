<?php

namespace webshop_v2\Controllers;

class RegistrationController extends UserController
{
    protected function UpdateModels(): bool
    {
        if (isset($_POST['form_submitted']))
        {
            $_SESSION['id'] = $this->user_model->setUser(
                $this->field_collection->getFieldByName('fname')->getValue(),
                $this->field_collection->getFieldByName('lname')->getValue(),
                $this->field_collection->getFieldByName('email')->getValue(),
                $this->field_collection->getFieldByName('password')->getValue()
            );

            $this->params->addArray($_SESSION);
        }

        return true;
    }
}
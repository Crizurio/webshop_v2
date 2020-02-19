<?php

namespace webshop_v2\Controllers;

class LoginController extends UserController
{
    protected function updateModels() : bool
    {
        $email = $this->field_collection->getFieldByName('email')->getValue();

        if (isset($_POST['form_submitted']))
        {
            $_SESSION['id'] = $this->user_model->getUserByEmail($email)['user_id'];

            $this->params->addArray($_SESSION);
        }

        return true;
    }
}
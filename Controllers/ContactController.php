<?php

namespace webshop_v2\Controllers;

class ContactController extends UserController
{
    protected function validate(): bool
    {
        return isset($_POST['form_submitted'])
            && $this->field_collection->validate();
    }

    protected function updateModels(): bool
    {
        if (isset($_POST['form_submitted']))
        {
            $this->user_model->setMessage(
                $this->field_collection->getFieldByName('name')->getValue(),
                $this->field_collection->getFieldByName('email')->getValue(),
                $this->field_collection->getFieldByName('message')->getValue()
            );

            return true;
        }

        return true;
    }
}

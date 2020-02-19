<?php

namespace webshop_v2\Controllers;

class ContactAjaxController extends AjaxController
{
    private $result;

    protected function createResponse() : bool
    {
        echo $this->result;
        return true;
    }

    protected function prepareResponse() : bool
    {
        $this->setContactInfoToDb();
        return true;
    }

    protected function retrieveData() : bool
    {
        //TODO gevoelig voor injectie
        $this->params->addArray($_POST);
        return true;
    }

    private function setContactInfoToDb() : string
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $message_model = $this->model_factory->getUserModel();

        $message_to_db = $message_model->setMessage($name, $email, $message);

        if (!$name == '' && !$email == '' && !$message == '')
        {
            $this->result .= '<h3><center>Hello ' . $name . '! You send the following 
            message to us: ' . '"' . $message . '"' . '<br>Thank you!</center> ';
            return $this->result;
        }
        else
        {
            $this->result .= '<h3><center>
            Please fill out all the fields to send us a message.</center>';
            return $this->result;
        }
    }
}
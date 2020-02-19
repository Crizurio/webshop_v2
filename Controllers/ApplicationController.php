<?php

namespace webshop_v2\Controllers;

use webshop_v2\Models as Models;
use webshop_v2\ControllerDelegators as ControllerDelegators;
use webshop_v2\Interfaces\iControllers as iControllers;

class ApplicationController implements iControllers\iController
{
    private $params;

    final public function resolveRequest() : bool
    {
        try 
        {        
            $this->getRequest();
            $this->delegate();
            return true;
        }
        catch (\throwable $error)
        {
            $this->showErrorPage($error);
            return false;
        }
    }

    protected function getRequest() : bool
    {
        if (!isset($_POST['page']) && !isset($_GET['url'])) {
            $this->redirectToHome();
        } else {
            $this->directTo();
        }

        if ($this->page === 'logout') {
            $this->logout();
        }

        if (isset($_SESSION)) {
            $this->params->addArray($_SESSION);
        }
        return true;
    }

    protected function delegate()
    {
        $delegator = new ControllerDelegators\ControllerDelegator(
            $this->page,
            $this->params
        );

        $controller = $delegator->delegate();
        $controller->resolveRequest();
    }

    private function redirectToHome()
    {
        if (isset($_SESSION)) {
            $this->params = new \webshop_v2\Params\Params($_SESSION);
        }
        $this->page = 'home';
    }

    private function directTo()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
        
            case 'POST':
                $this->page = filter_input(
                    INPUT_POST,
                    'page',
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
                
                $this->params = new \webshop_v2\Params\Params($_POST);
                break;

            case 'GET':
                $this->page = filter_input(
                    INPUT_GET,
                    'url',
                    FILTER_SANITIZE_SPECIAL_CHARS
                );

                $this->params = new \webshop_v2\Params\Params($_GET);
                break;
        }
    }

    public function logout()
    {
        unset($_SESSION['id']);
        session_destroy();
        $this->page = 'home';
    }

    private function showErrorPage($error)
    {
        echo '<h3 class = "error-page">
              <p> There has been an error. The following error was produced: <br>
              ' . $error->getMessage() . '<br>';

        echo '<a href = "index.php?url=home">Go back to the homepage</a>';
    }
}
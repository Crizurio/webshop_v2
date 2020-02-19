<?php

namespace webshop_v2\ControllerDelegators;

use webshop_v2\Models as Models;
use webshop_v2\Controllers as Controllers;

class ControllerDelegator
{
    private $params;
    private $page;

    public function __construct(
        string $page,
        \webshop_v2\Params\Params $params
    )
    
    {
        $this->page = $page;
        $this->params = $params;
    }

    public function delegate()
    {
        $crud = new \webshop_v2\Models\Crud();

        $model_factory = \webshop_v2\Models\ModelFactory::getinstance($crud);

        $element_factory =
            \webshop_v2\ElementFactory\ElementFactory::getInstance(
                $model_factory,
                \webshop_v2\Decorators\DecoratorFactory::getInstance(),
                $this->params
            );

        switch ($this->page) {

            case 'register':
                return new Controllers\RegistrationController(
                    $this->page,
                    $this->params,
                    $element_factory,
                    $model_factory
                );

            case 'login':
                return new Controllers\LoginController(
                    $this->page,
                    $this->params,
                    $element_factory,
                    $model_factory
                );

            case 'contact':
                return new Controllers\ContactController(
                    $this->page,
                    $this->params,
                    $element_factory,
                    $model_factory
                );

            case 'ajax_contact':

                return new Controllers\ContactAjaxController(
                    $this->page,
                    $this->params,
                    $element_factory,
                    $model_factory
                );

            default:

                return new Controllers\BaseController(
                    $this->page,
                    $this->params,
                    $element_factory,
                    $model_factory
                );
        }
    }
}
<?php

namespace webshop_v2\Controllers;

use webshop_v2\Models as Models;
use webshop_v2\Interfaces\iControllers as iControllers;

abstract class AbstractPageController extends BaseController
{
    protected $page;
    protected $model_factory;

    public function resolveRequest() : bool
    {
        $this->getRequest();
        if ($this->validate())
        {
            $this->updateModels();
        }

        return parent::resolveRequest();
    }

    abstract protected function getRequest(): bool;
    abstract protected function validate(): bool;
    abstract protected function updateModels(): bool;
}
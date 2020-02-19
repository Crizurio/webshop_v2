<?php

namespace webshop_v2\Controllers;

use webshop_v2\Models as Models;
use webshop_v2\Interfaces\iFactories as iFactories;
use webshop_v2\Interfaces\iControllers as iControllers;

abstract class AbstractBaseController implements iControllers\iController
{
    protected $element_factory;
    protected $page;
    protected $params;

    public function __construct(
        string $page,
        \webshop_v2\Params\Params $params,
        \webshop_v2\Interfaces\iFactories\iElementFactory $element_factory,
        Models\ModelFactory $model_factory
    )

    {
        $this->page = $page;
        $this->params = $params;
        $this->element_factory = $element_factory;
        $this->model_factory = $model_factory;
    }

    public function resolveRequest() : bool
    {
        $this->prepareResponse();
        $this->createResponse();
        return true;
    }

    abstract protected function prepareResponse() : bool;
    abstract protected function createResponse() : bool;
}

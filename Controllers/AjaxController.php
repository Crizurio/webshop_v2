<?php

namespace webshop_v2\Controllers;

use webshop_v2\Interfaces\iControllers as iControllers;
use webshop_v2\Models as Models;

abstract class AjaxController extends AbstractBaseController
{
    protected $element = null;

    public function resolveRequest() : bool
    {
        $this->retrieveData();
        return parent::resolveRequest();
    }

    protected function createResponse() : bool
    {
        $this->element = show();
        return true;
    }

    abstract protected function retrieveData() : bool;
}
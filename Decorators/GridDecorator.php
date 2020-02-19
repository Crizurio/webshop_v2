<?php

namespace webshop_v2\Decorator;

use webshop_v2\Attributes as Attributes;

class GridDecorator extends BaseDecorator
{
    public function __construct(\webshop_v2\Attributes\HtmlAttributes $attr_obj)
    {
        parent::__construct($attr_obj);
        $this->type = 'div';
    }
}
<?php

namespace webshop_v2\Elements;

use webshop_v2\Attributes as Attributes;

class GridElement extends BaseElement
{
    public function __construct(
        Attributes\HtmlAttributes $attr_obj
    )

    {
        $display_order = 15;
        parent::__construct($attr_obj, $display_order);
        $this->type = 'div';
    }

    protected function showMainContent() : string
    {   
        return '';
    }

}
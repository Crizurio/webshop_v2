<?php

namespace webshop_v2\Decorators;

use webshop_v2\Attributes as Attributes;

class ListOfLinksDecorator extends BaseDecorator
{
    public function __construct(Attributes\HtmlAttributes $attr_obj)
    {
        parent::__construct($attr_obj);
        $this->type = 'li';
    }

    protected function showMainContent() : string
    {
        return '<a href = "' . $this->data['href'] . '">'
            . $this->data['page'] . '</a>';
    }

    protected function transferDataToAttr() : bool
    {
        return true;
    }
}
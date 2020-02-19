<?php

namespace webshop_v2\Decorators;

use webshop_v2\Attributes as Attributes;

class NavBarDecorator Extends ListOfLinksDecorator
{
    public function __construct(Attributes\HtmlAttributes $attr_obj)
    {
        parent::__construct($attr_obj);
        $this->type = 'a';
    }

    protected function showMainContent() : string
    {
        return sprintf('%s', $this->data['page']);
    }

    protected function transferDataToAttr() : bool
    {
        $this->attr_obj->href = $this->data['href'];
        return true;
    }
}
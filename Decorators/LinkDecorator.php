<?php

namespace webshop_v2\Decorators;

class LinkDecorator extends BaseDecorator
{
    public function __construct(\webshop_v2\Attributes\HtmlAttributes $attr_obj)
    {
        parent::__construct($attr_obj);
        $this->type = 'a';
    }

    public function showMainContent() : string
    {
        return $this->data['page'];
    }

    protected function transferDataToAttr() : bool
    {
        $this->attr_obj->src = $this->data['src'];
        return true;
    }
}
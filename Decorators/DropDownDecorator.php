<?php

namespace webshop_v2\Decorators;

use webshop_v2\Attributes as Attributes;

abstract class DropDownDecorator extends BaseDecorator
{
    protected $key;
    protected $label;

    public function __construct(Attributes\HtmlAttributes $attr_obj)
    {
        parent::__construct($attr_obj);
        $this->type = 'option';
    }

    public function transferDataToAttr() : bool
    {
        $this->attr_obj->key = $this->key;
        $this->attr_obj->value = $this->data[$this->key];
        return true;
    }

    protected function showMainContent() : string
    {
        return sprintf('<span class = "dropdown-item">%s</span>',
            $this->data[$this->label]); 
    }
}
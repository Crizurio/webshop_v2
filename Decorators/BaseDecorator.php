<?php

namespace webshop_v2\Decorators;

use webshop_v2\Interfaces\iDecorators as iDecorators;
use webshop_v2\Attributes as Attributes;

abstract class BaseDecorator implements iDecorators\iDecorator
{
    protected $type;
    protected $data;
    protected $attr_obj;

    public function __construct(
        Attributes\HtmlAttributes $attr_obj
    )

    {
        $this->attr_obj = $attr_obj;
    }

    public function setData($data) : string
    {
        $this->data = $data;
        $this->transferDataToAttr();
        return $this->show();
    }

    final protected function show() : string
    {
        return sprintf('<%s %s>%s</%s>',
            $this->type,
            $this->attr_obj->toStr(),
            $this->showMainContent(),
            $this->type
        );

        return true;
    }

    protected function showMainContent() : string
    {
        return (is_array($this->data) ? implode(' ', $this->data) :
            $this->data);
    }

    protected function transferDataToAttr() : bool
    {
        return true;
    } 
}
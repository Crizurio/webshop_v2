<?php

namespace webshop_v2\Elements;

use webshop_v2\Interfaces\iDecorators as Decorators;
use webshop_v2\Attributes as Attributes;

abstract class ListElement extends BaseDecoratorElement
{
    public function __construct(
        $decorator, //Typing weggehaald TODO
        \webshop_v2\Models\ModelFactory $model_factory,
        Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )

    {
        parent::__construct(
            $decorator,
            $model_factory,
            $attr_obj,
            $display_order 
        );
        $this->type = 'ul';
    }
}
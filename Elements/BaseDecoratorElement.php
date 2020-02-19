<?php

namespace webshop_v2\Elements;

use webshop_v2\Interfaces\iDecorators as iDecorators;
use webshop_v2\Attributes as Attributes;

abstract class BaseDecoratorElement extends Presenter
{
    public function __construct(
        iDecorators\iDecorator $decorator,
        \webshop_v2\Models\ModelFactory $model_factory,
        Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )

    {
        parent::__construct(
            $model_factory,
            $attr_obj,
            $display_order
        );

        $this->decorator=$decorator;
    }

    protected function showMainContent() : string
    {
        $return_str = '';
        array_walk($this->content, function($item) use (&$return_str) {
            $return_str .= $this->decorator->setData($item);
        });
        return $return_str;
    }
}
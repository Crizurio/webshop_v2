<?php

namespace webshop_v2\Elements;

use webshop_v2\Attributes as Attributes;

class TextElement extends BaseElement
{
    public function __construct(
        $content,
        Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )

    {
        parent::__construct($attr_obj, $display_order);
        $this->content = $content;
        $this->type = 'p';
    }

    protected function showMainContent() : string
    {
        return $this->content;
    }

}

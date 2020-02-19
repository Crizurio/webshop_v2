<?php

namespace webshop_v2\Elements;

class TitleElement extends TextElement
{
    public function __construct(string $content)
    {
        $content = str_replace('_', '', $content);
        $attr_obj = new \webshop_v2\Attributes\HtmlAttributes(
            ['class' => 'title-text']
        );

        $display_order = 20;

        parent::__construct($content, $attr_obj, $display_order);
    }
}
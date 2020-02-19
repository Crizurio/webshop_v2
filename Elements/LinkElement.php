<?php

namespace TG_Wiki\Elements;

use TG_Wiki\Attributes as Attributes;

class LinkElement extends BaseElement
{
    public function __construct(
        $content,
        Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )
    {
        parent::construct($attr_obj, $display_order);
        $this->type = 'a';
        $this->content = $content;
        $this->attr_obj->href = $this->content['url'];

        $this->content = $content['page'];
    }

    protected function showMainContent(): string
    {
        return $this->content;
    }
}
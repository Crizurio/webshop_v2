<?php

namespace webshop_v2\Elements;

use webshop_v2\Attributes as Attributes;

class HeaderElement extends BaseElement
{
    public function __construct()
    {
        $attr_obj = new \webshop_v2\Attributes\HtmlAttributes(
            [
                'class' => 'logo',
                'src' => 'ROOT_PHOTO_DIR' . 'webshop_logo.jpeg' //TODO
            ]
        );

        $display_order = 10;

        parent::__construct($attr_obj, $display_order);
        $this->content = '<img style = "width:10%;"
                          src = "' . 'ROOT_PHOTO_DIR' . 'webshop_logo.jpeg">';

        $this->type = 'img';
    }

    protected function showMainContent() : string
    {
        return '';
    }
}
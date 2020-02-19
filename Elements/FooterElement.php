<?php

namespace webshop_v2\Elements;

class FooterElement extends BaseElement
{
    public function __construct()
    {
        $this->content = '&copy; Mitchell Bleeker ' . date('Y');
        $attr_obj = new \webshop_v2\Attributes\HtmlAttributes(
            ['class' => 'footer-text']
        );
        $display_order = 1000;

        parent::__construct($attr_obj, $display_order);
        $this->type = 'footer';
    }

    protected function showMainContent() : string
    {     
        //TODO footer aanzetten
        return '';   
        //return sprintf('<footer class="footer-text"><p>%s</p>', $this->content);
    }
}
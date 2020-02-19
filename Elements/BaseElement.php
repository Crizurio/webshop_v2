<?php

namespace webshop_v2\Elements;

use webshop_v2\Interfaces\iElements as iElements;
use webshop_v2\Attributes as Attributes;

abstract class BaseElement implements iElements\iElement
{
    protected $attr_obj;
    protected $type;
    protected $left;
    protected $right;
    protected $display_order;
    protected $content;

    public function __construct(
        Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )
    {
        $this->attr_obj = $attr_obj;
        $this->display_order = $display_order;
    }

    public function show() : bool
    {
        if ($this->left !== null) {
            $this->left->show();
        }

        $this->showNode();

        if ($this->right !== null) {
            $this->right->show();
        }
        return true;
    }

    public function insert(
        \webshop_v2\Interfaces\iElements\iElement $element) : bool
    {
        if($element->display_order < $this->display_order) {
            if($this->left === null) {
               $this->left = $element;
               return true;
            } else {
                $this->left->insert($element);
                return true;
            }
        }

        if($element->display_order >= $this->display_order) {
            if($this->right === null) {
               $this->right = $element;
               return true;
            } else {
               $this->right->insert($element);
               return true;
            }
        }
        return true;
    }

    public function showNode()
    {
        echo sprintf('<%s %s>%s</%s>',
            $this->type,
            $this->attr_obj->toStr(),
            $this->showMainContent(),
            $this->type
        );
    }

    abstract protected function showMainContent() :string;
}

<?php

namespace webshop_v2\Elements;

use webshop_v2\Interfaces\iDecorators as iDecorators;
use webshop_v2\Attributes as Attributes;
use webshop_v2\Decorators as Decorators;

class NavbarElement extends ListElement  
{
    private $logged_status;

    public function __construct(
        int $logged_status,
        \webshop_v2\Interfaces\iDecorators\iDecorator $decorator,
        \webshop_v2\Models\ModelFactory $model_factory,
        \webshop_v2\Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )

    {
        $this->logged_status = $logged_status;

        parent::__construct($decorator, $model_factory, $attr_obj, $display_order);
        $this->type = 'nav';
    }

    protected function getContent()
    {   
        $menu_items_model = $this->model_factory->getMenuItemsModel();
        $this->content = $menu_items_model->getMenuItems($this->logged_status);

        usort($this->content, function($a, $b) {
            return $a['display_order'] - $b['display_order'];
        });
    }

    protected function showMainContent() : string
    {
        $return_str = '';
        $parents = [];
        foreach($this->content as $menu_item) {
            $menu_item['page'] = str_replace('_', '', $menu_item['page']);
            if ($menu_item['parent_id'] === 0) {
                $parents[] = $menu_item;
            }
        }

        foreach ($parents as $parent) {
            $return_str .= $this->getChildren($parent);
        }

        return $return_str;
    }

    private function getChildren(array $parent) : string
    {
        $is_real_parent = false;
        $children = [];
        foreach($this->content as $menu_item) {
            $menu_item['page'] = str_replace('_', '', $menu_item['page']);
            if ($menu_item['parent_id'] === $parent['id']) {
                $is_real_parent = true;
                $children[] = $menu_item;
            }
        }

        if($is_real_parent) {
            $return_str = '<li class = "navitem dropdown">
                <a class="nav-link dropdown-toggle"
                data-toggle="dropdown" href = "#" id = "navbardrop">'
                . $parent['page'] . '</a>
                <div class = "dropdown-menu">';

            foreach($children as $child) {
                $return_str . $this->decorator->setData($child);
            }

            return $return_str . '</div></li>';
        } else {
            return $this->decorator->setData($parent);
        }
    }
}
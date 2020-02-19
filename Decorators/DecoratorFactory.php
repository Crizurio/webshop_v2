<?php

namespace webshop_V2\Decorators;

class DecoratorFactory
{
    private static $instance = null;

    protected function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DecoratorFactory();
        }

        return self::$instance;
    }

    public function createNavbarDecorator(
        \webshop_v2\Attributes\HtmlAttributes $attr_obj
    )

    {
        return new \webshop_v2\Decorators\NavbarDecorator($attr_obj);
    }

    public function createGridDecorator(
        \webshop_v2\Attributes\HtmlAttributes $attr_obj
    )

    {
        return new \webshop_v2\Decorators\GridDecorator($attr_obj);
    }
}
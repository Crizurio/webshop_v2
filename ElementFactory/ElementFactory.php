<?php

namespace webshop_v2\ElementFactory;

use webshop_v2\Interfaces\iFactories as iFactories;
use webshop_v2\Interfaces\iElements as iElements;

class ElementFactory implements iFactories\iElementFactory
{
    private static $instance = null;
    private $model_factory;
    private $params;
    private $decorator_factory;

    protected function __construct(
        \webshop_v2\Models\ModelFactory $model_factory,
        \webshop_v2\Decorators\DecoratorFactory $decorator_factory,
        \webshop_v2\Params\Params $params = null
    )
    {
        $this->model_factory = $model_factory;
        $this->decorator_factory = $decorator_factory;
        $this->params = $params;
    }

    //TODO kan dit naar $this-> ? AKA kleiner
    public static function getInstance(
        \webshop_v2\Models\ModelFactory $model_factory,
        \webshop_v2\Decorators\DecoratorFactory $decorator_factory,
        \webshop_v2\Params\Params $params = null
    )

    {
        if (self::$instance === null) {
            self::$instance = new ElementFactory (
                $model_factory,
                $decorator_factory,
                $params
            );
        }
        return self::$instance;
    }

    public function createNavbar(int $logged_status) :iElements\iElement
    {
        $display_order = 10;
        $attributes =
            [
                'class' =>
                [
                    'navbar',
                    'navbar-expand',
                    'bg-dark',
                ],
                'data-hover' => 'dropdown'
            ];

        $attr_obj = new \webshop_v2\Attributes\HtmlAttributes($attributes);

        $inner_attributes =
            [
                'class' => 'navbar-link-item'
            ];

        $decorator_attributes = new \webshop_v2\Attributes\HtmlAttributes(
            $inner_attributes
        );

        $decorator =
            new \webshop_v2\Decorators\NavBarDecorator($decorator_attributes);

        return new \webshop_v2\Elements\NavbarElement(
            $logged_status,
            $decorator,
            $this->model_factory,
            $attr_obj,
            $display_order
        );
    }

    public function createGridElement(string $page)  : iElements\iElement
    {
        $attributes =
        [
            'class' =>
            [
                'grid'
            ],
        ];

        $attr_obj = new \webshop_v2\Attributes\HtmlAttributes($attributes);

        return new \webshop_v2\Elements\GridElement(
        $attr_obj);
    }

    public function createTitleElement(string $page) : iElements\iElement
    {
        return new \webshop_v2\Elements\TitleElement(
            ucfirst($page)
        );
    }

    public function createFooterElement() : iElements\iElement
    {
        return new \webshop_v2\Elements\FooterElement();
    }

    public function createHeaderElement() : iElements\iElement
    {
        return new \webshop_v2\Elements\HeaderElement();
    }

    public function createBaseForm(
        string $page,
        \webshop_v2\Fields\FieldCollection $field_collection
    ) : iElements\iElement
    {
        return new \webshop_v2\Elements\BaseForm($page, $field_collection);
    }

    public function createElement(string $request, $data = null)
        : iElements\iElement
    {
        $attr_obj =
        new \webshop_v2\Attributes\HtmlAttributes($data['attributes']);

        switch ($request)
        {
            case 'text':

                return new \webshop_v2\Elements\TextElement(
                    $data['content'],
                    $attr_obj,
                    $data['display_order']
                );

            case 'sneakers_image':

                return new \webshop_v2\Elements\SneakersImageElement(
                    $this->model_factory,
                    $attr_obj,
                    $data['display_order']
                );

            case 'koffiezetapparaat_image':
                return new \webshop_v2\Elements\KoffiezetApparaatImageElement(
                    $this->model_factory,
                    $attr_obj,
                    $data['display_order']
                );

            case 'tennisracket_image':
                return new \webshop_v2\Elements\TennisracketImageElement(
                    $this->model_factory,
                    $attr_obj,
                    $data['display_order']
                );

            default:

                throw new \webshop_v2\Exceptions\PageNotFound(
                    "The requested page was not found."
                );
        }
    }
}

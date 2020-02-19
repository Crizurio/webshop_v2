<?php

namespace webshop_v2\Elements;

abstract class Presenter extends BaseElement
{
    protected $model_factory;
    protected $content = [];

    public function __construct(
        \webshop_v2\Models\ModelFactory $model_factory,
        \webshop_v2\Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )

    {
        parent::__construct(
            $attr_obj,
            $display_order
        );

        $this->model_factory = $model_factory;
        $this->getContent();
    }

    abstract protected function getContent();
}
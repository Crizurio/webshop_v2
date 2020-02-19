<?php

namespace webshop_v2\Elements;

class TennisracketImageElement extends Presenter
{
    public function __construct(
        \webshop_v2\Models\ModelFactory $model_factory,
        \webshop_v2\Attributes\HtmlAttributes $attr_obj,
        int $display_order
    )

    {
        parent::__construct($model_factory, $attr_obj, $display_order);
        $this->type = 'img';
    }

    protected function getContent()
    {      
        $product_model = $this->model_factory->getProductModel();
        $product = $product_model->getProduct(3);
        $this->attr_obj->src = "ProductPictures/" . $product['location'];
        $this->content = $this->attr_obj->src;        
    }

    protected function showMainContent() : string
    {
        //TODO waarom showt ie al de plaatjes?
        //return $this->content;
        return '';
    }
}
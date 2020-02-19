<?php

namespace webshop_v2\Models;

class ProductModel
{
    private $crud;

    public function __construct($crud)
    {
        $this->crud = $crud;
    }

    public function getProduct($product_id)
    {
        $query = 'SELECT * FROM products WHERE products.id = :product_id';

        $params = 
            [
                ':product_id' => [
                    'type' => \PDO::PARAM_INT,
                    'value' => $product_id
                ]
            ];

        if ($result = $this->crud->selectOne($query, $params))
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function getAllProducts()
    {
        $query = 'SELECT * FROM products';

        $params = 
            [

            ];

        if ($result = $this->crud->selectMany($query, $params))
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
}
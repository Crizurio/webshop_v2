<?php

namespace webshop_v2\Models;

class ModelFactory
{
    private $crud;
    private static $instance = null;

    protected function __construct($crud)
    {
        $this->crud = $crud;
    }

    public static function getInstance(\webshop_v2\Models\Crud $crud)
    {
        if(self::$instance === null) {
           self::$instance = new ModelFactory($crud);
        }

        return self::$instance;
    }

    public function getElementModel()
    {
        return new ElementModel($this->crud);
    }

    public function getMenuItemsModel()
    {
        return new MenuItemsModel($this->crud);
    }

    public function getFormModel()
    {
        return new FormModel($this->crud);
    }

    public function getUserModel()
    {
        return new UserModel($this->crud);
    }

    public function getProductModel()
    {
        return new ProductModel($this->crud);
    }
}
<?php

namespace webshop_v2\Models;

use webshop_v2\Interfaces\iModels as iModels;

class MenuItemsModel implements iModels\iMenuItemsModel
{
    private $crud;

    public function __construct($crud)
    {
        $this->crud = $crud;
    }

    public function getMenuItems(int $logged_status)
    {
        $query = 'SELECT id, parent_id, page, href, display_order FROM
            navbar_items WHERE login_status=:logged_status OR
            login_status = 2';

        $params = 
            [
                ':logged_status' => [
                    'type' => \PDO::PARAM_INT,
                    'value' => $logged_status
                ]
            ];
            
            return $this->crud->selectMany($query, $params);

    }
}
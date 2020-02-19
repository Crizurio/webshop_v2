<?php

namespace webshop_v2\Models;

use webshop_v2\Interfaces\iModels as iModels;

class ElementModel implements iModels\iElementModel
{
    private $crud;

    public function __construct($crud)
    {
        $this->crud = $crud;
    }

    public function getElementsByPage(string $page)
    {
        $query = 'SELECT Elements.name, Elements.display_order,
                  Elements.type, Elements.data
                  FROM Pages INNER JOIN
                  Link_page_elements ON Pages.id = Link_page_elements.page_ID
                  INNER JOIN Elements
                  ON Link_page_elements.element_id = Elements.id
                  WHERE Pages.name = :page';
        
        $params = 
            [
                ':page' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $page
                ]
            ];

        return $this->crud->selectMany($query, $params);
    }

    public function getElementsByName(string $element_name)
    {
        $query = 'SELECT type, display_order, name, data FROM
                  Elements WHERE Elements.name = :element_name';

        $params = 
            [
                ':element_name' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $element_name
                ]
            ];

        return $this->crud->selectOne($query, $params);
    }

    public function getStylesAndJavascriptsByPage(string $page)
    {
        $query = 'SELECT stylesheets, javascripts FROM pages WHERE name=:page';

        $params = 
            [
                ':page' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $page
                ]
            ];

        $result = $this->crud->selectOne($query, $params);
        if (!empty($result))
        {
            return ['stylesheets' => explode(',', $result['stylesheets']),
                'javascripts' => explode(',', $result['javascripts'])];
        }
        else
        {
            return $result;
        }
            
    }
}
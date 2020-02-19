<?php

namespace webshop_v2\Models;

class FormModel
{
    private $crud;

    public function __construct($crud)
    {
        $this->crud = $crud;
    }

    public function getForm(string $page)
    {
        $query = 
            'SELECT fields.name, fields.value, fields.label, fields.type,
             fields.attributes FROM fields INNER JOIN link_form_fields ON
             fields.id = link_form_fields.field_id INNER JOIN forms ON
             link_form_fields.form_id = forms.id WHERE forms.page = :page';

        $params = 
            [
                ':page' => [
                    'type' => \PDO::PARAM_STR,
                    'value' => $page
                ]
            ];

        return $this->crud->selectMany($query, $params);
    }
}
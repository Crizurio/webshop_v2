<?php

namespace webshop_v2\Elements;

use webshop_v2\Fields as Fields;

class BaseForm extends BaseElement
{
    private $page;

    public function __construct(
        string $page,
        Fields\FieldCollection $field_collection
    )

    {
        $attr_obj = new \webshop_v2\Attributes\HtmlAttributes(
            [
                'class' => 'form-inline',
                'action' => 'index.php',
                'method' => 'post',
                'encrype' => 'multipart/form-data'
            ]
        );

         $display_order = 120;
         parent::__construct(
             $attr_obj,
             $display_order
         );

         $this->page = $page;
         $this->type = 'form';
         $this->field_collection = $field_collection;
    }

    protected function showMainContent(): string
    {
        return $this->showFields();
    }

    protected function showFields() : string
    {
        $html_string = '';
        $error = false;
        $fields = $this->field_collection->getFieldCollection();

        array_walk($fields, function($field) use (&$html_string, &$error)
        {

            if ($field->isError()) {

                $error = true;
            }
            $html_string .= $field->show();
        });
        $html_string .= '<input type = "hidden" name = "page" value =
            "' . $this->page . '">';

        return $html_string;
    }
}
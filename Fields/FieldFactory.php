<?php

namespace webshop_v2\Fields;

abstract class FieldFactory
{
    public static function getField(array $fields)
    {
        switch ($fields['type']) 
        {
            case 'textarea':
                return new TextAreaField($fields);

            default:
                return new BaseField($fields);
        }
    }
}
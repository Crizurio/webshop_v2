<?php

namespace webshop_v2\Attributes;

class HtmlAttributes extends BaseKeyValue
{
    public function toStr() : string
    {
        $str = '';
        foreach($this->input_array as $key => $value) {
            $str .= $key . '="' . (is_array($value) ?
                implode(' ', $value) : $value) . '"';
        };
        return $str;
    }
}

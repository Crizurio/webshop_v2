<?php

namespace webshop_v2\Attributes;

abstract class BaseKeyValue
{
    protected $input_array;

    public function __construct(array $input_array)
    {
        $this->input_array = $input_array;
    }

    public function __get($key)
    {
        return $this->input_array[$key];
    }

    public function __set($key, $value)
    {
        $this->input_array[$key] = $value;
    }
}

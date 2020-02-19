<?php

namespace webshop_v2\Params;

class Params
{
    private $params_array;

    public function __construct(array $input_array)
    {
        $this->generateArray($input_array);
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->params_array)) {
            return null;
        }
        return $this->params_array[$key];
    }

    public function __set($key, $value)
    {
        $this->sanitizeAndAddValue($key, $value);
    }

    public function addArray(array $array)
    {
        $this->generateArray($array);
    }

    public function generateArray(array $input_array)
    {

        foreach($input_array as $key=>$value) {
            $this->sanitizeAndAddValue($key, $value);
        }
    }

    public function sanitizeAndAddValue($key, $value)
    {
        if ($key === 'id') {
            settype($value, 'integer');
        }

        switch(gettype($value)) {

            case 'string' :
                $sanitized_value = filter_var(
                    $value,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );

                $new_key = str_replace($key, 'str_' . $key, $key);

                $this->params_array[$new_key] = $sanitized_value;
                break;

            case 'integer' :
                $sanitized_value = filter_var(
                    $value,
                    FILTER_SANITIZE_NUMBER_INT
                );

                $new_key = str_replace($key, 'int_' . $key, $key);

                $this->params_array[$new_key] = (int)$sanitized_value;
                break;

            case 'array' :

                $new_key = str_replace($key, 'str_' . $key, $key);

                $this->params_array[$new_key] = $value;
                asort($this->params_array[$new_key]);
                
                break;
        }
    }
}
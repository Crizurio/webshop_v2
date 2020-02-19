<?php

namespace webshop_v2\Fields;

class BaseField
{
    protected $field_data;
    protected $error_message;
    protected $required = false;
    protected $attr_string;
    protected $error;


    public function __construct(array $field_data)
    {
        $this->field_data = $field_data;
        $this->attr_string = $this->createAttributes();
        if (preg_match('/required/', $this->attr_string))
        {
            $this->required = true;
        }
    }

    public function show() : string
    {
        return $this->createField();
    }

    public function getName()
    {
        return $this->field_data['name'];
    }

    public function getType()
    {
        return $this->field_data['type'];
    }

    public function getValue()
    {
        return $this->field_data['value'];
    }

    public function isError()
    {
        return $this->error;
    }

    public function setValue($value)
    {
        $this->field_data['value'] = $value;
    }

    public function setError($error)
    {
        $this->error = true;
        $this->error_message = $error;
    }

    public function isRequired()
    {
        return $this->required;
    }

    protected function createAttributes()
    {
        $attr_string = '';

        foreach ($this->field_data as $key => $value)
        {
            if ($key !== 'label' && $key !== 'attributes' && $key !== 'value')
            {
                $attr_string .= $key . '="' . $value . '" ';
            }

            if ($key === 'attributes' && $value !== null)
            {
                $attr_string .= $this->parseAttributes($value);
            }
        }

        return $attr_string;
    }

    protected function createField(): string
    {
        return sprintf('<label>%s <input %s value = "%s"></label>
                        <span class = "error-message">%s</span>',
                        $this->field_data['label'],
                        $this->attr_string,
                        $this->field_data['value'],
                        $this->error_message
        );
    }

    private function parseAttributes(string $input)
    {
        $attr_string ='';
        $xml = (array)simplexml_load_string($input);
        foreach ($xml as $key => $value)
        {
            $attr_string .= $key . '="' . (is_array($value)?
                implode(' ', $value) : $value) . '"';
        }

        return $attr_string;
    }
}
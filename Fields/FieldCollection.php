<?php

namespace webshop_v2\Fields;

class FieldCollection
{
    private $field_collection;
    private $val_factory;
    private $params;

    public function __construct(
        array $field_array,
        \webshop_v2\Validators\FieldValidatorFactory $val_factory,
        \webshop_v2\Params\Params $params
    )

    {
        $this->createFieldCollection($field_array);
        $this->val_factory = $val_factory;
        $this->params = $params;
    }

    public function getFieldByName($name)
    {
        return $this->field_collection[$name];
    }

    public function getFieldCollection()
    {
        return $this->field_collection;
    }

    public function validate(): bool
    {
        foreach ($this->field_collection as $field)
        {
            if ($field->getType() === 'submit' && $field instanceof Basefield)
            {
                continue;
            }

            $field_validator = $this->val_factory->getFieldValidator(
                $field->getName()
            );

            if ($field instanceof BaseField && !$field->isRequired()
                && ($field->getValue() === '' || $field->getValue() == null))
                {
                    continue;
                }
            
            if (!$field instanceof BaseField 
                || !$field_validator->validate($field))
                {
                    $field->setError($field_validator->getError());
                    return false;
                }
        
    }

        return true;
    }

    private function createFieldCollection(array $field_array)
    {
        foreach ($field_array as $field)
        {
            $this->field_collection[$field['name']] = 
                FieldFactory::getField($field);
        }
    }
}
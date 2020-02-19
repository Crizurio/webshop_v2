<?php

namespace webshop_v2\Fields;

class TextAreaField extends BaseField
{
    protected function createField(): string
    {
        return sprintf('<label>%s<textarea %s>%s</textarea></label>',
                        $this->field_data['label'],
                        $this->attr_string,
                        isset($this->field_data['value']) ?
                        $this->field_data['value'] : '' );
    }
}
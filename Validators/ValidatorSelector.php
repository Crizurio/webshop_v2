<?php

namespace webshop_v2\Validators;

class ValidatorSelector
{
    private $page;
    private $user_model;
    private $field_collection;

    public function __construct(
        string $page,
        \webshop_v2\Models\UserModel $user_model,
        \webshop_v2\Fields\FieldCollection $field_collection
    )

    {
        $this->page = $page;
        $this->user_model = $user_model;
        $this->field_collection = $field_collection;
    }

    public function getValidator()
    {
        switch ($this->page)
        {
            case 'login':
                return new LoginValidator($this->user_model, $this->field_collection);

            case 'register':
                return new RegisterValidator($this->user_model, $this->field_collection);
        }
    }
}
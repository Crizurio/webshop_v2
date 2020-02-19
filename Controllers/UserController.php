<?php

namespace webshop_v2\Controllers;

use webshop_v2\Models as Models;
use webshop_v2\Fields as Fields;
use webshop_v2\Elements as Elements;
use webshop_v2\Validators as Validators;

abstract class UserController extends AbstractPageController
{
    protected $user_model;
    protected $form_model;
    protected $field_collection;
    protected $validated = false;

    public function __construct(
        string $page,
        \webshop_v2\Params\Params $params,
        \webshop_v2\ElementFactory\ElementFactory $element_factory,
        \webshop_v2\Models\ModelFactory $model_factory
    )
    {
        parent::__construct($page, $params, $element_factory, $model_factory);
        $this->user_model = $this->model_factory->getUserModel();
    }

    protected function getRequest(): bool
    {
        $this->form_model = $this->model_factory->getFormModel();
        $field_array = $this->form_model->getForm($this->page);
        $field_validator_factory = new \webshop_v2\Validators\FieldValidatorFactory;
        $this->field_collection = new Fields\FieldCollection(
            $field_array,
            $field_validator_factory,
            $this->params
        );

        if (isset($_POST['form_submitted']))
        {
            $field_collection_array = $this->field_collection
            ->getFieldCollection();

            array_walk($field_collection_array, function($value, $name)
            {
                $this->field_collection->getFieldByName($name)
                     ->setValue(filter_input(
                        INPUT_POST,
                        $name,
                        ($name === 'email') ? FILTER_SANITIZE_EMAIL :
                                              FILTER_SANITIZE_SPECIAL_CHARS));
            });
        }

        return true;
    }

    protected function validate(): bool
    {
        if (isset($_POST['form_submitted']))
        {
            $validator = (new Validators\ValidatorSelector(
                $this->page,
                $this->user_model,
                $this->field_collection
            ))->getValidator();
        }

        if ($this->field_collection->validate()
            && $validator->validateCredentials())
        {
            $this->page = 'home';
            $this->validated = true;
            return true;
        }
        else 
        {
            return false;
        }

        return true;
    }

    protected function prepareResponse(): bool
    {
        parent::prepareResponse();

        if (!$this->validated)
        {
            $form = $this->element_factory->createBaseForm(
                $this->page,
                $this->field_collection
            );

            $this->html_page->addBodyElement($form);
        }

        return true;
    }
}
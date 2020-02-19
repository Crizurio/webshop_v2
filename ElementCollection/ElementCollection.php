<?php

namespace webshop_v2\ElementCollection;

class ElementCollection
{
    private $element_collection = [];
    private $model_factory;
    private $element_factory;

    public function __construct(
        \webshop_v2\Models\ModelFactory $model_factory,
        //\webshop_v2\Interfaces\Factories\iElementFactory $element_factory
        \webshop_v2\ElementFactory\ElementFactory $element_factory
    )
    {
        $this->model_factory = $model_factory;
        $this->element_factory = $element_factory;
    }

    public function getElementCollection()
    {
        return $this->element_collection;
    }

    public function addElement(array $element_blueprint)
    {
        $this->createElement($element_blueprint);
    }

    protected function createElement(array $element_blueprint)
    {
        $this->element_collection[] = $this->element_factory->createElement(
            $element_blueprint['type'],
            $this->createDataArray($element_blueprint)
        );
    }

    private function createDataArray(array $element_blueprint): array
    {
        $parsed_data = \webshop_v2\ElementParser\ElementParser::parseXml(
            $element_blueprint['data']
        );

        return
            [
                'content' => isset($parsed_data['content']) ?
                $parsed_data['content'] : '',
                'attributes' => $parsed_data['attributes'],
                'display_order' => $element_blueprint['display_order']
            ];
    }
}
<?php

namespace webshop_v2\Controllers;

use webshop_v2\Models as Models;
use webshop_v2\Interfaces\iFactories as iFactories;
use webshop_v2\Interfaces\iControllers as iControllers;

class BaseController extends AbstractBaseController
{

    protected $html_page;

    public function __construct(
        string $page,
        \webshop_v2\Params\Params $params,
        \webshop_v2\Interfaces\iFactories\iElementFactory $element_factory,
        Models\ModelFactory $model_factory
    )

    {
        parent::__construct($page, $params, $element_factory, $model_factory);
        $this->page = $page;
        $this->params = $params;
        $this->element_factory = $element_factory;
        $this->model_factory = $model_factory;
        $this->html_page = new \webshop_v2\Views\HtmlPage();
    }

    protected function addStandardElements() : bool
    {
        $this->addNavBar();
        $this->addTitle();
        $this->addHeader();
        $this->addGrid();
        $this->addFooter();
        return true;
    }

    protected function prepareResponse() : bool
    {
        $this->processElements();
        $this->addStandardElements();
        $this->processStylesAndJavascripts();
        return true;
    }

    protected function createResponse() : bool
    {
        $this->html_page->show();
        return true;
    }

    final protected function addNavBar()
    {
        $navbar_element = $this->element_factory->createNavBar(
            isset($_SESSION['id']) ? 1 : 0);

        $this->html_page->addBodyElement($navbar_element);
        return true;
    }

    final protected function addTitle()
    {
        $title_element = $this->element_factory->createTitleElement($this->page);

        $this->html_page->addBodyElement($title_element);
    }

    //TODO Logo?
    final protected function addHeader()
    {
        //$logo = $this->element_factory->createHeaderElement();

        //$this->html_page->addBodyElement($logo);
    }

    final protected function addGrid()
    {
        if ($this->page == 'products')
        {
            $grid_element = $this->element_factory->createGridElement($this->page);

            $this->html_page->addBodyElement($grid_element);
        }
        else
        {
            return false;
        }
    }
    final protected function addFooter()
    {
        $footer = $this->element_factory->createFooterElement();
        $this->html_page->addBodyElement($footer);
    }

    final protected function addStyleSheets(array $styles)
    {
        foreach($styles as $stylesheet) {
            $this->html_page->addStyleSheet($stylesheet);
        }
    }

    final protected function addJavaScripts(array $javascripts)
    {
        foreach($javascripts as $javascript)
        {
            $this->html_page->addJavaScript($javascript);
        }
    }

    final protected function processElements()
    {
        $elements_array = $this->model_factory
                               ->getElementModel()
                               ->getElementsByPage($this->page);

        if (count($elements_array) > 0) {
            $element_collection =
                new \webshop_v2\ElementCollection\ElementCollection(
                    $this->model_factory,
                    $this->element_factory
                );
            foreach($elements_array as $single_element_item) {
                    $element_collection->addElement(
                        $single_element_item,
                        $this->model_factory
                    );
            }

            foreach($element_collection->getElementCollection() as $element) {
                $this->html_page->addBodyElement($element);
            }
        }
    }

    final protected function processStylesAndJavascripts()
    {
        $styles_and_javascripts = $this->model_factory
                                       ->getElementModel()
                                       ->getStylesAndJavascriptsByPage($this->page);

        if(empty($styles_and_javascripts))
        {
            throw new \webshop_v2\Exceptions\PageNotFound(
                'Resources could not be loaded. Page will not show. Try again.'
            );
        }

        $this->addStyleSheets($styles_and_javascripts['stylesheets']);
        $this->addJavaScripts($styles_and_javascripts['javascripts']);
    }

    final protected function processError(\throwable $error)
    {
        $error_page =
            [
                'attributes' => [
                    'class' => 'error'
                ],

                'display_order' => 150,
                'content' => '<h2>' . $error->getMessage(). '</h2>'
            ];

        $text_element = $this->element_factory->createElement(
            'text',
            $error_page
        );

        $this->html_page->addBodyElement($text_element);
    }
}

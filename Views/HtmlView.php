<?php

namespace webshop_v2\Views;

use webshop_v2\Interfaces\iViews as iViews;
use webshop_v2\Interfaces\iElements as iElements;

abstract class HtmlView implements iViews\iView 
{
    
    public function show() : bool
    {
        $this->showOpenHeader();
        $this->showHeaderContent();
        $this->showCloseHeader();
        $this->showOpenBody();
        $this->showBodyContent();
        $this->showCloseBody();
    return true;
    }

    public function addStylesheet(string $stylesheet) : bool
    {
        $this->stylesheets[] = $stylesheet;
        return true;
    }

    public function addJavaScript(string $java_script) : bool
    {
        $this->java_scripts[] = $java_script;
        return true;
    }

    public function addBodyElement(iElements\iElement $body_element) : bool
    {
        if($this->body_elements === null) {
           $this->body_elements = $body_element;
        } else {
            $this->body_elements->insert($body_element);
        }

        return true;
    }

    abstract protected function showOpenHeader(): bool;
    abstract protected function showHeaderContent(): bool;
    abstract protected function showCloseHeader(): bool;
    abstract protected function showOpenBody(): bool;
    abstract protected function showBodyContent(): bool;
    abstract protected function showCloseBody(): bool;
}
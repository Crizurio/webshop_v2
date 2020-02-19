<?php

namespace webshop_v2\Interfaces\iFactories;

use webshop_v2\Interfaces\iElements as iElements;

interface iElementFactory
{
    public function createElement(
        string $request,
        array $data
    ) : iElements\iElement;

    public function createNavbar(int $logged_status) : iElements\iElement;

    public function createTitleElement(string $page) : iElements\iElement;

    public function createFooterElement() : iElements\iElement;

    public function createHeaderElement() : iElements\iElement;
}
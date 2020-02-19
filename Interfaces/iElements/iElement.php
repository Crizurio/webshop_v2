<?php

namespace webshop_v2\Interfaces\iElements;

interface iElement
{
    public function show() : bool;

    public function insert(iElement $element) : bool;
}
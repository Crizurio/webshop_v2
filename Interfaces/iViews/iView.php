<?php

namespace webshop_v2\Interfaces\iViews;

use webshop_v2\Interfaces\iElements as iElements;

interface iView
{
    public function show(): bool;

    public function addStyleSheet(string $stylesheet): bool;

    public function addBodyElement(iElements\iElement $body_element): bool;
}
<?php

namespace webshop_v2\Interfaces\iModels;

interface iElementModel
{
    public function getElementsByPage(string $page);

    public function getElementsByName(string $element_name);
}
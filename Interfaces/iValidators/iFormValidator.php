<?php

namespace webshop_v2\Interfaces\iValidators;

interface iFormValidator
{
    public function validateCredentials(): bool;
}
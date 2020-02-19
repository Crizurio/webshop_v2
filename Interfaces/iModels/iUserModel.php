<?php

namespace webshop_v2\Interfaces\iModels;

interface iUserModel
{
    public function getUserByEmail(string $email);

    public function setUser(
        string $fName,
        string $lName,
        string $email,
        string $password
    ): int;

    public function setMessage(
        string $name,
        string $email,
        string $message
    ): bool;
}
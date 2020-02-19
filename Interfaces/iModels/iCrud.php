<?php

namespace webshop_v2\Interfaces\iModels;

interface iCrud
{
    public function doUpdateOrDelete(string $query, array $params): int;
    public function selectMany(string $query, array $params): array;
    public function selectOne(string $query, array $params): array;
    public function doInsert(string $query, array $params): int;
}
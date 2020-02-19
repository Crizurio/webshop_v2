<?php

namespace webshop_v2\Models;

use webshop_v2\Interfaces\iModels as iModels;

class Crud implements iModels\iCrud
{
    public function __construct()
    {
        $this->PDO = CreatePDO::getPDO();
    }

    public function doUpdateOrDelete(string $query, array $params = null) : int
    {
        $statement = $this->execute($query, $params);
        return $statement->rowCount();
    }

    public function selectOne(string $query, array $params = null) : array
    {
        $statement = $this->execute($query, $params);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public function selectMany(string $query, array $params = null) : array
    {
        $statement = $this->execute($query, $params);
        $results = [];
        do
        {
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
            {
                $results[] = $row;
            }
        }
        while ($statement->nextRowset());
        return $results;
    }

    public function doInsert(string $query, array $params = null) : int
    {
        $statement = $this->execute($query, $params);
        return intval($this->PDO->lastInsertId());
    } 

    public function execute(string $query, array $params = null)
    {
        $statement = $this->PDO->prepare($query);
        if ($params !== null) {
            foreach ($params as $key => $value) {
                $statement->bindValue(
                    $key, $value['value'],
                    $value['type']
                );
            }
        }
        if (!$statement->execute()) {
            throw new DatabaseFailedException($query . ' has failed');
        }
        return $statement;
    }
}
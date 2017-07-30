<?php

namespace App\GraphQL;

use App\GraphQL\Type\Query;
use GraphQL\Type\Definition\ObjectType;

class QueryBuilder
{
    protected $types = [];

    public function registerType(ObjectType $type): void
    {
        $this->types[] = $type;
    }

    function query(): Query
    {
        return new Query();
    }
}
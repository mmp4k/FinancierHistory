<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class Query extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'hello' => [
                    'type' => Type::string(),
                    'resolve' => function() {
                        return 'asd';
                    }
                ]
            ]
        ]);
    }
}
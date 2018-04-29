<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\VisitorModel;

class VisitorType extends GraphQLType
{
    protected $attributes = [
        'name' => 'VisitorType',
        'description' => 'A type',
        'model' => VisitorModel::class
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'          => Type::int(),
                'description'   => 'The ID',
            ],
            'ip'    => [
                'type'          => Type::string(),
                'description'   => 'The IP Adress',
            ],
            'country'    => [
                'type'          => Type::string(),
                'description'   => 'The Country',
            ],
            'city'    => [
                'type'          => Type::string(),
                'description'   => 'The City',
            ],
            'useragent'    => [
                'type'          => Type::string(),
                'description'   => 'The User Agent',
						],
						'platform'    => [
							'type'          => Type::string(),
							'description'   => 'The Platform',
					],
        ];
    }
}
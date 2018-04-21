<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\UsersModel;

class UsersType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UsersType',
        'description' => 'A type',
        'model' => UsersModel::class
    ];

    public function fields()
    {
        return [
						'id'    => [
                'type'          => Type::int(),
                'description'   => 'The ID',
            ],
            'username'    => [
                'type'          => Type::string(),
                'description'   => 'The Player Name',
            ],
            'slug'    => [
							'type'          => Type::string(),
							'description'   => 'The Player Slug',
						],
						'email'    => [
							'type'          => Type::string(),
							'description'   => 'The Player Mail',
						],
						'player_role'    => [
							'type'          => Type::string(),
							'description'   => 'The Player Role',
						],
						'active'    => [
							'type'          => Type::int(),
							'description'   => 'The Player Status',
						]
        ];
    }
}
<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\PlayersModel;

class PlayersType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PlayersType',
        'description' => 'A type',
        'model' => PlayersModel::class
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'          => Type::int(),
                'description'   => 'The Player ID',
            ],
            'name'  => [
                'type'          => Type::string(),
                'description'   => 'The Player Name',
            ],
            'slug'  => [
                'type'          => Type::string(),
                'description'   => 'The Player Slug',
            ],
            'hashtag'  => [
                'type'          => Type::string(),
                'description'   => 'The Player Hashtag',
            ],
            'active'  => [
                'type'          =>  Type::int(),
                'description'   => 'Is Player Active?',
            ],
            'ranked'   => [
                'type'          => GraphQL::type('ranking'),
                'description'   => 'Player Ranking',
            ],
            'playtime'   => [
                'type'          => Type::listOf(GraphQL::type('playtime')),
                'description'   => 'Player Playtime',
            ],
            'trends'   => [
                'type'          => Type::listOf(GraphQL::type('trends')),
                'description'   => 'Player Trends',
            ],
            'users'   => [
                'type'          => Type::listOf(GraphQL::type('users')),
                'description'   => 'Player User Account',
            ],
        ];
    }
}
<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\Player;

class OverwatchPlayerType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'OverwatchPlayerType',
        'description'   => 'An Overwatch Player',
        'model'         => Player::class
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
                'type'          => GraphQL::type('overwatchPlayerRank'),
                'description'   => 'Player Ranking',
            ],
            'playtime'   => [
                'type'          => Type::listOf(GraphQL::type('overwatchPlayerPlaytime')),
                'description'   => 'Player Playtime',
            ]
        ];
    }
}
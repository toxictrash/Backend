<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\TrendsModel;

class TrendsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'TrendsType',
        'description' => 'A type',
        'model' => TrendsModel::class
    ];

    public function fields()
    {
        return [
			'id'    => [
                'type'          => Type::int(),
                'description'   => 'The ID',
            ],
            'player_id'    => [
                'type'          => Type::int(),
                'description'   => 'The Player ID',
            ],
            'player_ranking'    => [
							'type'          => Type::int(),
							'description'   => 'The Player Ranking',
						],
						'player_tier'    => [
							'type'          => Type::string(),
							'description'   => 'The Player Tier',
						],
						'player_games_total'    => [
							'type'          => Type::int(),
							'description'   => 'The Player Games Total',
						],
						'player_games_won'    => [
							'type'          => Type::int(),
							'description'   => 'The Player Games Won',
						],
						'player_games_draw'    => [
							'type'          => Type::int(),
							'description'   => 'The Player Games Draw',
						],
						'player_games_lose'    => [
							'type'          => Type::int(),
							'description'   => 'The Player Games Lose',
						],
            'ranked'   => [
                'type'          => GraphQL::type('ranking'),
                'description'   => 'Player Ranking',
            ],
            'playtime'   => [
                'type'          => Type::listOf(GraphQL::type('playtime')),
                'description'   => 'Player Playtime',
            ]
        ];
    }
}
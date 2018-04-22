<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\RankingModel;

class RankingType extends GraphQLType
{
    protected $attributes = [
        'name' => 'RankingType',
        'description' => 'A type',
        'model'       => RankingModel::class
    ];

    public function fields()
    {
			return [
				'player_id'    => [
				'type'          => Type::int(),
				'description'   => 'The Player ID',
				],
				'player_ranking'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Ranking',
				],
				'player_prestige'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Prestige',
				],
				'player_level'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Level',
				],
				'player_current_tier'    => [
				'type'          => Type::string(),
				'description'   => 'The Player Tier',
			],
			'player_should_tier'    => [
				'type'          => Type::string(),
				'description'   => 'The Player Tier he should be',
			],
				'player_avatar'    => [
				'type'          => Type::string(),
				'description'   => 'The Player Avatar',
			],
				'player_medals_total'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Total Medals',
			],
				'player_medals_gold'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Gold Medals',
			],
				'player_medals_silver'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Silver Medals',
			],
				'player_medals_bronze'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Bronze Medals',
			],
				'player_games_total'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Total Games',
			],
				'player_games_won'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Won Games',
			],
				'player_games_draw'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Draw Games',
			],
				'player_games_lose'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Lost Games',
			],
				'player_healing_done'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Healing',
			],
				'player_damage_done'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Damage',
			],
				'player_kills'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Kills',
			],
				'player_deaths'    => [
				'type'          => Type::int(),
				'description'   => 'The Player Deaths',
			],
				'player_kpd'    => [
				'type'          => Type::string(),
				'description'   => 'The Player Kills Per Death',
			],
				'playtime'        => [
				'type'  => Type::listOf(GraphQL::type('playtime')),
				'description'   => 'The Player Most Played Characters',
			],
				'player'  => [
				'type'  => GraphQL::type('players'),
				'description'   => 'The Player',
				],
				'trends'   => [
					'type'          => Type::listOf(GraphQL::type('trends')),
					'description'   => 'Player Trends',
				],
				'users'   => [
					'type'          => Type::listOf(GraphQL::type('users')),
					'description'   => 'User Account',
				],
			];
    }
}
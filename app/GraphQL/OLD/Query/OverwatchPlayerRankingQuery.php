<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Overwatch\Ranking;

class OverwatchPlayerRankingQuery extends Query
{
		protected $attributes = [
			'name' => 'OverwatchPlayerRankingQuery',
			'description' => 'Overwatch Player Ranking Query'
		];

		public function type()
    {
        return Type::listOf(GraphQL::type('overwatchPlayerRank'));
		}

		public function args()
    {
			return [
				'player_id' => ['name' => 'player_id', 'type' => Type::int()],
				'ranking' => ['name' => 'player_ranking', 'type' => Type::int()],
				'level' => ['name' => 'player_level', 'type' => Type::int()],
				'prestige' => ['name' => 'player_prestige', 'type' => Type::int()],
				'tier' => ['name' => 'player_current_tier', 'type' => Type::string()],
				'avatar' => ['name' => 'avatar', 'type' => Type::string()],
				'medalsTotal' => ['name' => 'medalsTotal', 'type' => Type::int()],
				'medalsGold' => ['name' => 'medalsGold', 'type' => Type::int()],
				'medalsSilver' => ['name' => 'medalsSilver', 'type' => Type::int()],
				'medalsBronze' => ['name' => 'medalsBronze', 'type' => Type::int()],
				'gamesTotal' => ['name' => 'gamesTotal', 'type' => Type::int()],
				'gamesWon' => ['name' => 'gamesWon', 'type' => Type::int()],
				'gamesDraw' => ['name' => 'gamesDraw', 'type' => Type::int()],
				'gamesLost' => ['name' => 'gamesLost', 'type' => Type::int()],
				'healing' => ['name' => 'healing', 'type' => Type::int()],
				'damage' => ['name' => 'damage', 'type' => Type::int()],
				'kills' => ['name' => 'kills', 'type' => Type::int()],
				'deaths' => ['name' => 'deaths', 'type' => Type::int()],
				'kpd' => ['name' => 'kpd', 'type' => Type::string()],
				'character_role' => ['name' => 'kpd', 'type' => Type::string()],
			];
		}

			public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
			{
					/*if (isset($args['id'])) {
							return Ranking::where('player_id', $args['id'])->get();
					} else {
							return Ranking::orderBy('player_ranking', 'DESC')->get();
					}*/

					$where = function ($query) use ($args) {
            if (isset($args['player_id'])) {
                $query->where('player_id', $args['player_id']);
						}
						if (isset($args['tier'])) {
							$query->where('player_current_tier', $args['tier']);
						}
        };
        $ranking = Ranking::orderBy('player_ranking', 'DESC');
        $ranking->where($where);
        $ranking->select($fields->getSelect());
        return $ranking->get();
			}
}
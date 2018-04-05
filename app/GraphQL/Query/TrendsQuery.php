<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Overwatch\TrendsModel;


class TrendsQuery extends Query
{
    protected $attributes = [
        'name' => 'TrendsQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('trends'));
    }

    public function args()
    {
        return [
            'player_id' => ['name' => 'player_id', 'type' => Type::int()],
            'player_tier' => ['name' => 'player_tier', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $where = function ($query) use ($args) {
            if (isset($args['player_id'])) {
                $query->where('player_id', $args['player_id']);
            }
            if (isset($args['player_tier'])) {
                $query->where('player_tier', $args['player_tier']);
            }
        };
        $trends = TrendsModel::where($where);
        $trends->select($select);
        $trends->with($with);
        $trends->orderBy('id', 'DESC');
        return $trends->get();
    }
}
<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Overwatch\PlayersModel;


class PlayersQuery extends Query
{
    protected $attributes = [
        'name' => 'PlayersQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('players'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'user_id' => ['name' => 'user_id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'slug' => ['name' => 'slug', 'type' => Type::string()],
            'hashtag' => ['name' => 'hashtag', 'type' => Type::string()],
            'active' => ['name' => 'active', 'type' => Type::boolean()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id', $args['id']);
            }
            if (isset($args['user_id'])) {
                $query->where('user_id', $args['user_id']);
            }
            if (isset($args['name'])) {
                $query->where('name', $args['name']);
            }
            if (isset($args['slug'])) {
                $query->where('slug', $args['slug']);
            }
            if (isset($args['hashtag'])) {
                $query->where('hashtag', $args['hashtag']);
            }
        };
        $player = PlayersModel::OnlyActive();
        $player->where($where);
        $player->select($select);
        $player->with($with);
        $player->orderBy('id', 'DESC');
        return $player->get();
    }
}
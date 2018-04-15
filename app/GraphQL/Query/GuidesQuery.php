<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Overwatch\GuidesModel;


class GuidesQuery extends Query
{
    protected $attributes = [
        'name' => 'GuidesQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('guides'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'title' => ['name' => 'title', 'type' => Type::string()],
            'slug' => ['name' => 'slug', 'type' => Type::string()],
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
            if (isset($args['title'])) {
                $query->where('title', $args['title']);
            }
            if (isset($args['slug'])) {
                $query->where('slug', $args['slug']);
            }
        };
        $player = GuidesModel::OnlyActive();
        $player->where($where);
        $player->select($select);
        $player->with($with);
        $player->orderBy('id', 'DESC');
        return $player->get();
    }
}
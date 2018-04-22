<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Overwatch\VodModel;


class VodQuery extends Query
{
    protected $attributes = [
        'name' => 'VodQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('vods'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'user_id' => ['name' => 'user_id', 'type' => Type::int()],
            'youtube_id' => ['name' => 'youtube_id', 'type' => Type::string()],
            'youtube_title' => ['name' => 'youtube_title', 'type' => Type::string()],
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
            if (isset($args['youtube_id'])) {
                $query->where('youtube_id', $args['youtube_id']);
            }
            if (isset($args['youtube_title'])) {
                $query->where('youtube_title', $args['youtube_title']);
            }
        };
        $trends = VodModel::OnlyActive();
        $trends->where($where);
        $trends->select($select);
        $trends->with($with);
        $trends->orderBy('id', 'DESC');
        return $trends->get();
    }
}
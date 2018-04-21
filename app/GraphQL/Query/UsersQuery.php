<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Overwatch\UsersModel;


class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'UsersQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('users'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'username' => ['name' => 'username', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'player_role' => ['name' => 'player_role', 'type' => Type::string()],
            'slug' => ['name' => 'slug', 'type' => Type::string()],
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
            if (isset($args['username'])) {
                $query->where('username', $args['username']);
						}
						if (isset($args['email'])) {
							$query->where('email', $args['email']);
						}
        };
				$trends = UsersModel::OnlyActive();
				$trends->where($where);
        $trends->select($select);
        $trends->with($with);
        $trends->orderBy('id', 'DESC');
        return $trends->get();
    }
}
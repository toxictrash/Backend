<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Overwatch\UsersModel;

class RegisterMutation extends Mutation
{
	protected $attributes = [
		'name' => 'RegisterMutation',
		'description' => 'A mutation'
	];

	public function type()
	{
			return GraphQL::type('users');
	}

	public function args() {
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'username' => ['name' => 'username', 'type' => Type::string()],
			'email' => ['name' => 'email', 'type' => Type::string()],
			'password' => ['name' => 'password', 'type' => Type::string()],
			'player_role' => ['name' => 'player_role', 'type' => Type::string()],
		];
	}

	public function resolve($root, $args) {
		$args['password'] = bcrypt($args['password']);
		$args['slug'] = str_slug($args['username']);
		// $args['active'] = '0';
		$user = UsersModel::create($args);
		if (!$user) {
			return null;
		}
		return $user;
	}

}
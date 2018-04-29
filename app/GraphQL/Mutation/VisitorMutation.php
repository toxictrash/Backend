<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Overwatch\VisitorModel;

class VisitorMutation extends Mutation
{
		protected $attributes = [
			'name' => 'VisitorMutation',
			'description' => 'A mutation'
		];

		public function type()
		{
			return GraphQL::type('visitor');
		}

		public function args()
    {
        return [
						'ip' => ['name' => 'ip', 'type' => Type::string()],
						'country' => ['name' => 'country', 'type' => Type::string()],
						'city' => ['name' => 'city', 'type' => Type::string()],
						'useragent' => ['name' => 'useragent', 'type' => Type::string()],
						'platform' => ['name' => 'platform', 'type' => Type::string()],
        ];
		}

		public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
			$array = [
				'ip'				=> $args['ip'],
				'country'		=> $args['country'],
				'city'			=> $args['city'],
				'useragent'	=> $args['useragent'],
				'platform'	=> $args['platform'],
			];
			$model = new VisitorModel($array);
			$model->save();
      return $model;
		}
}
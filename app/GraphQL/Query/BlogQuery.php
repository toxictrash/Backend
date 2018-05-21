<?php

namespace App\GraphQL\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Blog\PostsModel;

class BlogQuery extends Query
{
	protected $attributes = [
		'name' => 'BlogQuery',
		'description' => 'A query'
	];

	public function type()
	{
			return Type::listOf(GraphQL::type('posts'));
	}

	public function args()
	{
			return [
					'id' => ['name' => 'id', 'type' => Type::int()],
					'category_id' => ['name' => 'category_id', 'type' => Type::int()],
					'title' => ['name' => 'title', 'type' => Type::string()],
					'slug' => ['name' => 'slug', 'type' => Type::string()],
					'text' => ['name' => 'text', 'type' => Type::string()],
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
					if (isset($args['category_id'])) {
						$query->where('category_id', $args['category_id']);
					}
					if (isset($args['title'])) {
							$query->where('title', $args['title']);
					}
					if (isset($args['slug'])) {
							$query->where('slug', $args['slug']);
					}
			};
			$posts = PostsModel::OnlyActive();
			$posts->where($where);
			$posts->select($select);
			$posts->with($with);
			$posts->orderBy('id', 'DESC');
			return $posts->get();
	}
}
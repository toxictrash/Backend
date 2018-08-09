<?php

namespace App\GraphQL\Query;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Models\Auctioneer\AuctionModel;

class AuctionQuery extends Query
{
	protected $attributes = [
		'name' => 'AuctionQuery',
		'description' => 'A query'
	];

	public function type()
	{
			return Type::listOf(GraphQL::type('auctions'));
	}

	public function args()
	{
			return [
					'id' => ['name' => 'id', 'type' => Type::int()],
					'item_id' => ['name' => 'item_id', 'type' => Type::int()],
					'owner' => ['name' => 'owner', 'type' => Type::string()],
					'ownerRealm' => ['name' => 'ownerRealm', 'type' => Type::string()],
					'slug' => ['name' => 'slug', 'type' => Type::string()],
					'bid' => ['name' => 'bid', 'type' => Type::string()],
					'buyout' => ['name' => 'buyout', 'type' => Type::string()],
					'quanity' => ['name' => 'bid', 'type' => Type::int()],
					'timeLeft' => ['name' => 'timeLeft', 'type' => Type::string()],
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
					if (isset($args['item_id'])) {
						$query->where('item_id', $args['item_id']);
					}
					if (isset($args['owner'])) {
							$query->where('owner', $args['owner']);
					}
					if (isset($args['ownerRealm'])) {
							$query->where('ownerRealm', $args['ownerRealm']);
					}
					if (isset($args['slug'])) {
						$query->where('slug', $args['slug']);
					}
					if (isset($args['timeLeft'])) {
						$query->where('timeLeft', $args['timeLeft']);
					}
			};
			$auctions = AuctionModel::where($where);
			$auctions->select($select);
			$auctions->with($with);
			$auctions->orderBy('id', 'DESC');
			return $auctions->get();
	}
}
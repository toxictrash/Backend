<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Auctioneer\AuctionModel;

class AuctionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AuctionType',
        'description' => 'A type',
        'model' => AuctionModel::class
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'          => Type::int(),
                'description'   => 'The Auction ID',
            ],
            'item_id'    => [
                'type'          => Type::int(),
                'description'   => 'The Auction Item ID',
            ],
            'owner'  => [
                'type'          => Type::string(),
                'description'   => 'The Auction Owner',
						],
						'ownerRealm'  => [
							'type'          => Type::string(),
							'description'   => 'The Auction Owner Realm',
						],
            'slug'  => [
                'type'          => Type::string(),
                'description'   => 'The Auction Slug',
            ],
            'bid'  => [
                'type'          => Type::string(),
                'description'   => 'The Auction Bid',
            ],
						'buyout'  => [
							'type'          => Type::string(),
							'description'   => 'The Auction Buyout',
						],
						'quantity'    => [
							'type'          => Type::int(),
							'description'   => 'The Auction Quantity',
						],
						'timeLeft'    => [
							'type'          => Type::string(),
							'description'   => 'The Auction Timeleft',
						],
        ];
    }
}
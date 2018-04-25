<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\NewsModel;

class NewsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'NewsType',
        'description' => 'A type',
        'model' => NewsModel::class
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'          => Type::int(),
                'description'   => 'The News ID',
						],
						'category_id'    => [
							'type'          => Type::int(),
							'description'   => 'The News Category ID',
						],
            'title'  => [
                'type'          => Type::string(),
                'description'   => 'The News Title',
            ],
            'slug'  => [
                'type'          => Type::string(),
                'description'   => 'The News Slug',
            ],
            'text'  => [
                'type'          => Type::string(),
                'description'   => 'The News Text',
            ],
            'active'  => [
                'type'          =>  Type::int(),
                'description'   => 'Is News Active?',
            ],
        ];
    }
}
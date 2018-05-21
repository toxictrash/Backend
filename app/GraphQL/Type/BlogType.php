<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Blog\PostsModel;

class BlogType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BlogType',
        'description' => 'A type',
        'model' => PostsModel::class
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'          => Type::int(),
                'description'   => 'The Post ID',
            ],
            'category_id'    => [
                'type'          => Type::int(),
                'description'   => 'The Post Category ID',
            ],
            'title'  => [
                'type'          => Type::string(),
                'description'   => 'The Post Title',
            ],
            'slug'  => [
                'type'          => Type::string(),
                'description'   => 'The Post Slug',
            ],
            'text'  => [
                'type'          => Type::string(),
                'description'   => 'The Post Text',
            ],
            'active'  => [
                'type'          =>  Type::int(),
                'description'   => 'Is Post Active?',
            ]
        ];
    }
}
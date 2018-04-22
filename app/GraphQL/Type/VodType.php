<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\VodModel;

class VodType extends GraphQLType
{
    protected $attributes = [
        'name' => 'VodType',
        'description' => 'A type',
        'model' => VodModel::class
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'          => Type::int(),
                'description'   => 'The ID',
            ],
            'user_id'    => [
                'type'          => Type::int(),
                'description'   => 'The Player Account',
            ],
            'youtube_id'    => [
                'type'          => Type::string(),
                'description'   => 'The Youtube ID',
            ],
            'youtube_thumbnail'    => [
                'type'          => Type::string(),
                'description'   => 'The Thumbnail',
            ],
            'youtube_title'    => [
                'type'          => Type::string(),
                'description'   => 'The Title',
            ],
            'youtube_duration'    => [
                'type'          => Type::string(),
                'description'   => 'The Duration',
            ],
            'users'   => [
                'type'          => Type::listOf(GraphQL::type('users')),
                'description'   => 'User Account',
            ],
        ];
    }
}
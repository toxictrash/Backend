<?php

namespace App\GraphQL\Type;

use GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use App\Models\Overwatch\GuidesModel;

class GuidesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'GuidesType',
        'description' => 'A type',
        'model' => GuidesModel::class
    ];

    public function fields()
    {
        return [
            'id'    => [
                'type'          => Type::int(),
                'description'   => 'The Guide ID',
            ],
            'title'  => [
                'type'          => Type::string(),
                'description'   => 'The Guide Title',
            ],
            'slug'  => [
                'type'          => Type::string(),
                'description'   => 'The Guide Slug',
            ],
            'text'  => [
                'type'          => Type::string(),
                'description'   => 'The Guide Text',
            ],
            'thumbnail'  => [
                'type'          => Type::string(),
                'description'   => 'The Guide Thumbnail',
            ],
            'characters'  => [
                'type'          => Type::string(),
                'description'   => 'The Guide Characters',
            ],
            'maps'  => [
                'type'          => Type::string(),
                'description'   => 'The Guide Maps',
            ],
            'active'  => [
                'type'          =>  Type::int(),
                'description'   => 'Is Guide Active?',
            ],
            'created_at'  => [
                'type'          => Type::string(),
                'description'   => 'The Guide Creation',
            ],
        ];
    }
}
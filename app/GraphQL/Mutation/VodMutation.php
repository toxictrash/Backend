<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Overwatch\VodModel;

class VodMutation extends Mutation
{
    protected $attributes = [
        'name' => 'VodMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('vods');
    }

    public function args()
    {
        return [
            'youtube_id' => ['name' => 'youtube_id', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $vod = VodModel::where('youtube_id', $args['youtube_id']);
        if ($vod) {
            return null;
        } else {
            $model = new VodModel();
            $model->youtube_id = $args['youtube_id'];
            $model->active = 0;
            $model->save();
            return $model;
        }
    }
}
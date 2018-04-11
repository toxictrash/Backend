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
        $vod = VodModel::where('youtube_id', $args['youtube_id'])->get();
        if (!$vod->isEmpty()) {
            return null;
        } else {
            $array = [
                'youtube_id' => $args['youtube_id'],
                'youtube_thumbnail' => '',
                'youtube_title' => '',
                'youtube_duration' => '',
                'active' => '0',
            ];
            $model = new VodModel($array);
            $model->save();
            return $model;
        }
    }
}
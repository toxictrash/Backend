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
        $youtubeId = str_replace('https://www.youtube.com/watch?v=', '', $args['youtube_id']);
        $vod = VodModel::where('youtube_id', $youtubeId)->get();
        if (!$vod->isEmpty()) {
            return null;
        } else {
            $array = [
                'youtube_id' => $youtubeId,
                'youtube_thumbnail' => '',
                'youtube_title' => '',
                'youtube_duration' => '',
                'processed' => '0',
                'active' => '0',
            ];
            $model = new VodModel($array);
            $model->save();
            return $array;
        }
    }
}
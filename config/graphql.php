<?php

use App\GraphQL\Query\PlaytimeQuery;
use App\GraphQL\Type\PlaytimeType;
use App\GraphQL\Query\RankingQuery;
use App\GraphQL\Type\RankingType;
use App\GraphQL\Query\PlayersQuery;
use App\GraphQL\Type\PlayersType;
use App\GraphQL\Query\TrendsQuery;
use App\GraphQL\Type\TrendsType;
use App\GraphQL\Query\VodQuery;
use App\GraphQL\Type\VodType;
use App\GraphQL\Mutation\VodMutation;
use App\GraphQL\Query\GuidesQuery;
use App\GraphQL\Type\GuidesType;
use App\GraphQL\Query\NewsQuery;
use App\GraphQL\Type\NewsType;
use App\GraphQL\Type\VisitorType;
use App\GraphQL\Mutation\VisitorMutation;
use App\GraphQL\Query\BlogQuery;
use App\GraphQL\Type\BlogType;

return [
    'prefix' => 'graphql',
    'routes' => '{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => [],
    'default_schema' => 'default',
    'schemas' => [
        'default' => [
            'query' => [
                'playtimeQuery' => PlaytimeQuery::class,
                'rankingQuery'  => RankingQuery::class,
                'playerQuery'   => PlayersQuery::class,
                'trendsQuery'   => TrendsQuery::class,
                'vodQuery'      => VodQuery::class,
                'guidesQuery'   => GuidesQuery::class,
                'newsQuery'     => NewsQuery::class,
                'blogQuery'     => BlogQuery::class
            ],
            'mutation' => [
                'vodMutation'       => VodMutation::class,
                'visitorMutation'   => VisitorMutation::class
            ],
            'middleware' => [
                'api'
            ]
        ],
    ],
    'types' => [
        'playtime'  => PlaytimeType::class,
        'ranking'   => RankingType::class,
        'players'   => PlayersType::class,
        'trends'    => TrendsType::class,
        'vods'      => VodType::class,
        'guides'    => GuidesType::class,
        'news'      => NewsType::class,
        'visitor'   => VisitorType::class,
        'posts'     => BlogType::class
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'params',
];

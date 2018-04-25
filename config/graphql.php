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
                'NewsQuery'     => NewsQuery::class
            ],
            'mutation' => [
                'vodMutation'   => VodMutation::class,
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
        'news'      => NewsType::class
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'params',
];

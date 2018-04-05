<?php

use App\GraphQL\Query\PlaytimeQuery;
use App\GraphQL\Type\PlaytimeType;
use App\GraphQL\Query\RankingQuery;
use App\GraphQL\Type\RankingType;

use App\GraphQL\Query\PlayersQuery;
use App\GraphQL\Type\PlayersType;

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
                'playerQuery'   => PlayersQuery::class
            ],
            'mutation' => [ ],
            'middleware' => [
                'api'
            ]
        ],
    ],
    'types' => [
        'playtime'  => PlaytimeType::class,
        'ranking'   => RankingType::class,
        'players'   => PlayersType::class
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'params',
];

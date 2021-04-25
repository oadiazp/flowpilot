<?php

define('APP_ROOT', __DIR__);

return [
    'displayErrorDetails' => true,
    'determineRouteBeforeAppMiddleware' => false,

    'doctrine' => [
        // if true, metadata caching is forcefully disabled
        'dev_mode' => true,

        // path where the compiled metadata info will be cached
        // make sure the path exists and it is writable
        'cache_dir' => APP_ROOT . '/var/doctrine',

        // you should add any other path containing annotated entity classes
        'metadata_dirs' => [APP_ROOT . '/src/Domain'],

        'connection' => [
            'driver' => 'pdo_mysql',
            'host' => getenv('DB_HOST'),
            'port' => 3306,
            'dbname' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf-8'
        ]
    ]
];

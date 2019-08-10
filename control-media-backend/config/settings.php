<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => true, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,
            'cache_dir' => __DIR__ . '/var/doctrine',
            'metadata_dirs' => [__DIR__ . '/src/Domain'],

            'connection' => [
                'driver' => 'pdo_mysql',
                'port' => 3306,
                'host' => 'db',
                'dbname' => 'test_db',
                'user' => 'devuser',
                'password' => 'devpass'
            ],

            'connection_unit_test' => [
                'driver' => 'pdo_mysql',
                'port' => 3306,
                'host' => 'db_test_unit',
                'dbname' => 'test_db',
                'user' => 'devuser',
                'password' => 'devpass'
            ]
        ]
    ],
];

<?php

return [
    /**
     * Ip2Location configuration
     */
    'ip2location' => [
        /**
         * Process ip data count per cycle
         * 
         * @var int
         * @default 1000
         */
        'process_ip_data_per_cycle' => 1000,

        /**
         * Database configuration
         */
        'database' => [
            'driver' => 'mysql',
            'host' => env('IP2LOCATION_MYSQL_HOST', '127.0.0.1'),
            'port' => env('IP2LOCATION_MYSQL_PORT', '1010'),
            'database' => env('IP2LOCATION_MYSQL_DBNAME', 'ip2location_database'),
            'username' => env('IP2LOCATION_MYSQL_USERNAME', 'admin'),
            'password' => env('IP2LOCATION_MYSQL_PASSWORD', 'secret'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]
    ]
];

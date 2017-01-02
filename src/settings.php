<?php

$dbString = getenv("DATABASE_URL");
$dbConfig = parse_url($dbString);

$settings = array(
    'determineRouteBeforeAppMiddleware' => true,
    'displayErrorDetails' => false,
    'db' => array(
        'driver' => 'pgsql',
        'host' => $dbConfig['host'],
        'database' => ltrim($dbConfig['path'], '/'),
        'username' => $dbConfig['user'],
        'password' => $dbConfig['pass'],
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ),
    'redis' => array(),
    'logger' => array()
);

switch (SLIM_ENV) {
    case 'testing':
        break;
    case 'development':
        break;
    default: // Production settings
}

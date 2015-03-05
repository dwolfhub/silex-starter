<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

// get relevant config file and register service provider
$app['env'] = getenv('APPLICATION_ENV');
$envConfigFileLoc = __DIR__ . '/config/' . $app['env'] . '.yml';
$defaultConfigFileLoc = __DIR__ . '/config/default.yml';
$configFileLoc = file_exists($envConfigFileLoc)? $envConfigFileLoc: $defaultConfigFileLoc;
$app->register(new DerAlex\Silex\YamlConfigServiceProvider($configFileLoc));

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => $app['config']['mysql.driver'],
        'host' => $app['config']['mysql.host'],
        'user' => $app['config']['mysql.user'],
        'password' => $app['config']['mysql.password'],
        'dbname' => $app['config']['mysql.dbname'],
        'charset' => $app['config']['mysql.charset'],
    ],
]);

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views',
]);


return $app;
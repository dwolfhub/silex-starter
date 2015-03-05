<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['env'] = getenv('APPLICATION_ENV');

// config
$envConfigFileLoc = __DIR__ . '/config/' . $app['env'] . '.yml';
$defaultConfigFileLoc = __DIR__ . '/config/default.yml';
$configFileLoc = file_exists($envConfigFileLoc)? $envConfigFileLoc: $defaultConfigFileLoc;
$app->register(new DerAlex\Silex\YamlConfigServiceProvider($configFileLoc));

$app['debug'] = $app['config']['debug'];

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $app['config']['database']
]);

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views',
]);


return $app;
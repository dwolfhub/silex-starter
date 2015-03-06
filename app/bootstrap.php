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

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $app['config']['database']
]);

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views',
]);

$app->register(new \Knp\Provider\ConsoleServiceProvider(), array(
    'console.name'              => $app['config']['name'],
    'console.version'           => $app['config']['version'],
    'console.project_directory' => __DIR__ . '/..'
));

$app->register(new \Knp\Provider\MigrationServiceProvider(), array(
    'migration.path' => __DIR__.'/../src/Migration'
));

return $app;
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['env'] = getenv('APPLICATION_ENV');

// config
$envConfigFileLoc = __DIR__ . '/config/' . $app['env'] . '.yml';
$defaultConfigFileLoc = __DIR__ . '/config/default.yml';
$configFileLoc = file_exists($envConfigFileLoc)? $envConfigFileLoc: $defaultConfigFileLoc;
$app->register(new DerAlex\Silex\YamlConfigServiceProvider($configFileLoc));

// debug mode
$app['debug'] = $app['config']['debug'];

// database
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $app['config']['database']
]);

// twig is not always necessary
//$app->register(new Silex\Provider\TwigServiceProvider(), [
//    'twig.path' => __DIR__ . '/../views',
//]);

// console app
$app->register(new \Knp\Provider\ConsoleServiceProvider(), array(
    'console.name'              => $app['config']['name'],
    'console.version'           => $app['config']['version'],
    'console.project_directory' => __DIR__ . '/..'
));

return $app;
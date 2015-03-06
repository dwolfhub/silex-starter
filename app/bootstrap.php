<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

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
//    'twig.path' => dirname(__DIR__) . '/frontend/twig',
//]);

// console app
$app->register(new \Knp\Provider\ConsoleServiceProvider(), array(
    'console.name'              => $app['config']['name'],
    'console.version'           => $app['config']['version'],
    'console.project_directory' => dirname(__DIR__)
));

return $app;
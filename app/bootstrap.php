<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Silex\Application();
$app['env'] = getenv('APPLICATION_ENV');

// Config
$envConfigFileLoc = __DIR__ . '/config/' . $app['env'] . '.yml';
$defaultConfigFileLoc = __DIR__ . '/config/default.yml';
$configFileLoc = file_exists($envConfigFileLoc)? $envConfigFileLoc: $defaultConfigFileLoc;
$app->register(new DerAlex\Silex\YamlConfigServiceProvider($configFileLoc));

// Debug mode
$app['debug'] = $app['config']['debug'];

// Database
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $app['config']['database']
]);

// Logging
$app->register(new Silex\Provider\MonologServiceProvider(), [
        'monolog.logfile' => __DIR__ . '/logs/app.log',
]);

// Security
//$app->register(new Silex\Provider\SecurityServiceProvider());

// Cache
//$app->register(new Silex\Provider\HttpCacheServiceProvider(), [
//    'http_cache.cache_dir' => __DIR__ . '/cache/',
//]);
//
// Templates
//$app->register(new Silex\Provider\TwigServiceProvider(), [
//    'twig.path' => dirname(__DIR__) . '/frontend/twig',
//]);
//
// Console Commands
//$app->register(new Knp\Provider\ConsoleServiceProvider(), [
//    'console.name'              => $app['config']['name'],
//    'console.version'           => $app['config']['version'],
//    'console.project_directory' => dirname(__DIR__)
//]);

return $app;
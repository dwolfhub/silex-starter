<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Silex\Application();
$app['env'] = getenv('APPLICATION_ENV');

// Config
$envConfigFileLoc = __DIR__ . '/config/' . $app['env'] . '.yml';
$defaultConfigFileLoc = __DIR__ . '/config/default.yml';
$configFileLoc = file_exists($envConfigFileLoc)? $envConfigFileLoc: $defaultConfigFileLoc;
$app->register(new DerAlex\Silex\YamlConfigServiceProvider($configFileLoc));

// Debug mode?
$app['debug'] = $app['config']['debug'];

// Console Commands
$app->register(new Knp\Provider\ConsoleServiceProvider(), [
    'console.name' => $app['config']['name'],
    'console.version' => $app['config']['version'],
    'console.project_directory' => dirname(__DIR__),
]);

// Database
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => $app['config']['database']
]);
$app->register(
    new \Kurl\Silex\Provider\DoctrineMigrationsProvider($app['console']),
    [
        'migrations.directory' => __DIR__ . '/migrations',
        'migrations.name' => 'Migrations',
        'migrations.namespace' => 'SilexStarter\Migrations',
        'migrations.table_name' => 'migrations',
    ]
);

// Logging
$app->register(new Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => __DIR__ . '/logs/app.log',
    'monolog.level' => constant('\Monolog\Logger::' . $app['config']['logging']['level']),
    'monolog.name' => $app['config']['name'],
]);

// Cache
$app->register(new Silex\Provider\HttpCacheServiceProvider(), [
    'http_cache.cache_dir' => __DIR__ . '/cache/',
]);

// Templates
$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => dirname(__DIR__) . '/frontend/twig'
]);

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addGlobal(
        'js_filename',
        json_decode(file_get_contents(dirname(__DIR__) . '/public_html/assets/assets.json'))->{'app.js'}
    );
    $twig->addGlobal(
        'css_filename',
        json_decode(file_get_contents(dirname(__DIR__) . '/public_html/assets/assets.json'))->{'style.css'}
    );
    return $twig;
}));

$app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

return $app;
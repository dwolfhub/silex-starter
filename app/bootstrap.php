<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = new

$app = new Silex\Application();
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array( // TODO: get these from the config
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'user' => 'meetapet',
        'password' => 'GGL;5"^wLP(8}*n',
        'dbname' => 'map_live',
        'charset' => 'utf8',
    ),
));
$app->register(new \Meetapet\Google\Geocode\GeocodeServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

return $app;
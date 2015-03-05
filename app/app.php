<?php

$app = require __DIR__ . '/bootstrap.php';

$app['debug'] = $app['config']['debug'];

// Routes
$app->get('/', 'SilexStarter\Controller\HomeController::index');

return $app;

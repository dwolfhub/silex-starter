<?php

$app = require __DIR__ . '/bootstrap.php';

// Routes
//$app->get('/', 'SilexStarter\Controller\HomeController::index');

$app['console']->add(new \Knp\Command\MigrationCommand());

return $app;
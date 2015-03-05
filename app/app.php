<?php

$app = require __DIR__ . '/bootstrap.php';

// Routes
$app->get('/', 'SilexStarter\Controller\HomeController::index');

return $app;

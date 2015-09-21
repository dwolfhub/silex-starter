<?php

$app = require __DIR__ . '/bootstrap.php';

// Routes
$app->get('/', 'SilexStarter\Controller\HomeController::index')
    ->bind('home');

$app->error(function (Exception $e, $code) use ($app) {
    if (!$app['debug']) {
        return $app['twig']->render('error.html.twig', [
            'msg' => $e->getMessage(),
            'code' => $code,
        ]);
    }
});

return $app;
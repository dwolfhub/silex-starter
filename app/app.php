<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = require __DIR__ . '/bootstrap.php';

// Routes
$app->get('/', 'SilexStarter\Controller\HomeController::index');


// Security
$secureRoutes = [
    '/',
    '/admin'
];
$app->before(function (Request $request, \Silex\Application $app) use ($secureRoutes) {
    if (in_array($request->getRequestUri(), $secureRoutes)) {
        $token = $request->headers->get('X-Auth-Token', false);
        if ($token !== false) {
            $usersRepo = new \SilexStarter\QueryRepository\UserQueryRepository($app['db']);
            $user = $usersRepo->getUserByToken($token);
            if ($user) {
                $app['user'] = $user;
                return;
            }
        }
        throw new \SilexStarter\Exception\RequiresAuthenticationException('Invalid Auth Token');
    }
});
$app->error(function (\SilexStarter\Exception\RequiresAuthenticationException $e, $code) {
    return new \Symfony\Component\HttpFoundation\JsonResponse([
        'status' => 'error',
        'message' => $e->getMessage()
    ], $code);
});

// Enabling CORS
$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});

return $app;
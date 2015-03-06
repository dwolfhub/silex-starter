<?php
/**
 * User: danielwolf
 * Date: 3/5/15
 * Time: 3:56 PM
 */

namespace SilexStarter\Controller;

use Silex\Application;
use SilexStarter\QueryRepository\UserQueryRepository;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

    /**
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Application $app, Request $request) {
        $usersRepo = new UserQueryRepository($app['db']);
        $users = $usersRepo->getAll();

        return $app->json(
            [
                'key' => 'val',
                'params' => $request->query->all(),
                'users' => $users
            ],
            200,
            [
                'Cache-Control' => 's-maxage=3600, public'
            ]
        );
    }
}
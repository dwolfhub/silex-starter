<?php
/**
 * User: danielwolf
 * Date: 3/5/15
 * Time: 3:56 PM
 */

namespace SilexStarter\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

    /**
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Application $app, Request $request) {
        return $app['twig']->render('home.html.twig');
    }
}
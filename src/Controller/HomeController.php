<?php
/**
 * User: danielwolf
 * Date: 3/5/15
 * Time: 3:56 PM
 */

namespace SilexStarter\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController {

    /**
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Application $app, Request $request) {
        $responseText = $app['twig']->render('home.html.twig');

        return new Response($responseText, 200, [
            'Cache-Control' => 's-maxage=3600, public',
        ]);
    }
}
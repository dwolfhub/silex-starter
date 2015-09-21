<?php

namespace SilexStarter\Test;

use Silex\WebTestCase;

abstract class AbstractTestCase extends WebTestCase
{
    public function createApplication()
    {
        $app = require dirname(dirname(__DIR__)) . '/app/app.php';

        return $app;
    }
}
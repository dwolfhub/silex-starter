<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = require __DIR__ . '/bootstrap.php';

$app['debug'] = true; // TODO: set this from config

return $app;

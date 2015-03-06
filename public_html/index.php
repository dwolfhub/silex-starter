<?php

$app = require_once dirname(__DIR__) . '/app/app.php';

// enable cached responses when Cache-Control header set by response
//$app['http_cache']->run();

$app->run();
<?php

$app = require_once dirname(__DIR__) . '/app/app.php';

$app['http_cache']->run();
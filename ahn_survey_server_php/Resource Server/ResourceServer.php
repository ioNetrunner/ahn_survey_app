<?php

/*
 * Roy Gustafson - (C) Allegheny Health Network 2017
 * <roy.gustafson@ahn.org> or <royagustafson@gmail.com>
 */

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../src/settings.php';

$app = new \Slim\App($settings);

require __DIR__ . '/../src/dependencies.php';   // Set up dependencies
require __DIR__ . '/../src/middleware.php';     // Register middleware
require __DIR__ . '/../src/routes.php';         // Register routes

$app->run();
?>
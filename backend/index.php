<?php

require 'vendor/autoload.php';

use FastRoute\Dispatcher;

$routes = require 'src/Routes/routes.php';
$dispatcher = FastRoute\simpleDispatcher($routes);

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if ($httpMethod === 'OPTIONS') {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Cache-Control');
    exit(0);
}

// Strip query string (?foo=bar) and decode URI
$uri = parse_url($uri, PHP_URL_PATH);
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404 Not Found';
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405 Method Not Allowed';
        break;
    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handler($vars);
        break;
}

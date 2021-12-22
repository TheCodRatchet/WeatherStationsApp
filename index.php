<?php

require_once "vendor/autoload.php";

header('Content-Type: application/json');


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/weather-json', 'WeatherStation1Controller@index');
    $r->addRoute('GET', '/weather-json/{index:\d+}', 'WeatherStation1Controller@details');
    $r->addRoute('GET', '/weather-csv', 'WeatherStation2Controller@index');
    $r->addRoute('GET', '/weather-csv/{index:\d+}', 'WeatherStation2Controller@details');
    $r->addRoute('GET', '/midweather', 'MidWeatherStationsController@index');
    $r->addRoute('GET', '/midweather/{index:\d+}', 'MidWeatherStationsController@details');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = explode('@', $handler);
        $controller = 'App\Controllers\\' . $controller;
        $controller = new $controller();
        $controller->$method($vars['index']);
        break;
}
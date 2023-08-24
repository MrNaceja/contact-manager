<?php

use Bramus\Router\Router;

function varlog(mixed $log) {
    if (is_array($log)) {
        echo '<pre>';
            echo var_dump($log);
        echo '</pre>';
        return;
    }
    if (is_callable($log)) {
        echo $log();
        return;
    }
    echo $log;
}

function isEmpty($value) {
    return empty($value) || is_null($value) || $value === '' || $value === false;
}

function parseUrlRoute(string $route) {
    return $_ENV['APP_URL_BASE']. DIRECTORY_SEPARATOR. ltrim($route, '/');
}

function isRoute(string $route) {
    $currentUrl    = (new Router())->getCurrentUri();
    $urlSegments   = explode('/', trim($currentUrl, '/'));
    $routeSegments = explode('/', trim($route     , '/'));
    return count(array_intersect($urlSegments, $routeSegments)) === count($routeSegments);
}

function getSendedData() {
    $data = json_decode(file_get_contents('php://input'), true);
    return array_merge($data, $_POST);
}
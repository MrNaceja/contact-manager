<?php

use Bramus\Router\Router;

/**
 * Debug de variaveis.
 * 
 * @param mixed $log
 */
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

/**
 * Verifica se uma variável está vazia.
 * 
 * @param mixed $values
 * @return bool
 */
function isEmpty($value) {
    return empty($value) || is_null($value) || $value === '' || $value === false;
}

/**
 * Criar uma url base referente ao dominio do app conforme rota.
 * 
 * @param string $route
 */
function parseUrlRoute(string $route) {
    return $_ENV['APP_URL_BASE']. DIRECTORY_SEPARATOR. ltrim($route, '/');
}

/**
 * Cria uma url apontanto para a rota fornecido conforme url atual.
 * 
 * @param string $route
 */
function toRoute(string $route) {
    return (new Router())->getCurrentUri() . $route;
}

/**
 * Verifica se a rota fornecida é a rota atual em execução.
 * 
 * @param string $route
 * @return bool
 */
function isRoute(string $route) {
    $currentUrl    = (new Router())->getCurrentUri();
    $urlSegments   = explode('/', trim($currentUrl, '/'));
    $routeSegments = explode('/', trim($route     , '/'));
    return count(array_intersect($urlSegments, $routeSegments)) === count($routeSegments);
}
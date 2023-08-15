<?php

namespace App\Controller;

use ArrayIterator;
use Closure;

abstract class RouteController {

    private static $routes;
    
    public static function get(string $endpointAction, string|Closure $handler, string $method = 'index') {
        $handler = is_string($handler) ? [$handler, $method] : $handler;
        self::addRoute('GET', $endpointAction, $handler);
    }

    public static function post(string $endpointAction, string|Closure $handler, string $method = 'index') {
        $handler = is_string($handler) ? [$handler, $method] : $handler;
        self::addRoute('POST', $endpointAction, $handler);
    }

    private static function addRoute(string $httpMethod, string $endpointAction, mixed $handler) {
        if (!isset(self::$routes)) {
            self::$routes = new ArrayIterator(['GET' => new ArrayIterator(), 'POST' => new ArrayIterator()]);
        }
        $routes = self::$routes->offsetGet($httpMethod);
        if (!$routes->offsetExists($endpointAction)) {
            $routes->offsetSet($endpointAction, $handler);
        }
    }

    public static function listen() {
        $Request          = new RequestController();
        $actionEndpoint   = $Request->getEndpointUrl();
        $routesMethodHttp = self::$routes->offsetGet($Request->getMethodHttp());
        if ($routesMethodHttp->offsetExists($Request->getEndpointUrl())) {
            $routeHandler = $routesMethodHttp->offsetGet($actionEndpoint);
            if (is_array($routeHandler)) {
                list ($controller, $method) = $routeHandler;
                if (class_exists($controller) && method_exists($controller, $method)) {
                    $ControllerRoute = new $controller();
                    return $ControllerRoute->$method($Request->getParams());
                }
                echo 'Controlador e/ou método da rota não definido - 500 (Internal server error)';
            }
            return $routeHandler($Request->getParams());
        }
        echo 'Página não encontrada😥 - 404 (Page not found)';
    }
    
}
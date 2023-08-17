<?php

namespace App\Controller;

use ArrayIterator;
use Closure;

abstract class RouteController {

    private static $routes;
    private static $Request;
    
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

    public static function isRoute(string $route) {
        $Request = self::getRequest();
        // Remove a barra inicial, se houver
        $currentUrl = ltrim($Request->getEndpointUrl(), '/');
        // Divide a URL atual em segmentos
        $urlSegments = explode('/', $currentUrl);
        
        // Divide a rota em segmentos
        $routeSegments = explode('/', trim($route, '/'));
        
        // Verifica se os primeiros segmentos da URL correspondem à rota
        return count(array_intersect($urlSegments, $routeSegments)) === count($routeSegments);
    }
    

    private static function getRequest() {
        if (!isset(Self::$Request)) {
            self::$Request = new RequestController();
        }
        return self::$Request;
    }

    public static function listen() {
        $Request          = self::getRequest();
        $actionEndpoint   = $Request->getEndpointUrl();
        $routesMethodHttp = self::$routes->offsetGet($Request->getMethodHttp());
        if ($routesMethodHttp->offsetExists($actionEndpoint)) {
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
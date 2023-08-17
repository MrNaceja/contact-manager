<?php

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

function parseUrlRoute(string $route) {
    return $_ENV['APP_URL_BASE']. DIRECTORY_SEPARATOR. ltrim($route, '/');
}

function isEmpty($value) {
    return empty($value) || is_null($value) || $value === '' || $value === false;
}
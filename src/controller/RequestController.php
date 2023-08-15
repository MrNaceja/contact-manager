<?php

namespace App\Controller;

class RequestController {

    public function getMethodHttp() : string {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function getEndpointUrl() : string {
        return $_SERVER['REQUEST_URI'];
    }

    public function getParams() : array{
        return array_merge($_GET, $_POST);
    }

}
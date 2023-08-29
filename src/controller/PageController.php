<?php

namespace App\Controller;

use League\Plates\Engine;

abstract class PageController {

    protected $View;

    public function __construct() {
        $this->View = new Engine(__DIR__.'../../view', 'php');
    }

    protected function redirectWithSuccess(string $route, $msgTitle, $msgContent) {
        $_SESSION['message'] = ['type' => 'success', 'title' => $msgTitle, 'content' => $msgContent];
        return $this->redirect($route);
    }
    
    protected function redirectWithError(string $route, $msgTitle, $msgContent) {
        $_SESSION['message'] = ['type' => 'error', 'title' => $msgTitle, 'content' => $msgContent];
        return $this->redirect($route);
    }

    protected function redirect($route) {
        header('Location: '. parseUrlRoute($route));
    }
    
}
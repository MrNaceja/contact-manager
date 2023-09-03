<?php

namespace App\Controller;

use League\Plates\Engine;

abstract class PageController {

    /**
     * Visualizações da página.
     * 
     * @var Engine
     */
    protected $View;

    public function __construct() {
        $this->View = new Engine(__DIR__.'../../view', 'php');
    }

    /**
     * Redireciona para a página fornecida com uma mensagem de sucesso.
     */
    protected function redirectWithSuccess(string $route, $msgTitle, $msgContent) {
        $_SESSION['message'] = ['type' => 'success', 'title' => $msgTitle, 'content' => $msgContent];
        return $this->redirect($route);
    }
    
    /**
     * Redireciona para a página fornecida com uma mensagem de erro.
     */
    protected function redirectWithError(string $route, $msgTitle, $msgContent) {
        $_SESSION['message'] = ['type' => 'error', 'title' => $msgTitle, 'content' => $msgContent];
        return $this->redirect($route);
    }

    /**
     * Redireciona a página para a rota fornecida.
     */
    protected function redirect($route) {
        header('Location: '. parseUrlRoute($route));
    }

}
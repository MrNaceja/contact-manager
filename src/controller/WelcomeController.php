<?php

namespace App\Controller;

use App\Controller\PageController;

class WelcomeController extends PageController {

    /**
     * Visualização de boas vindas do app.
     */
    public function index() {
       echo $this->View->render('WelcomeView', ['title' => 'Contact Manager']);
    }

    /**
     * Lida com rotas não existentes, apresenta uma visualização de página 404.
     */
    public function handlePageNotFound() {
        echo $this->View->render('NotFoundView');
    }

}
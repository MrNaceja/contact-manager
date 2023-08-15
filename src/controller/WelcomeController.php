<?php

namespace App\Controller;

use App\Controller\PageController;

class WelcomeController extends PageController {

    public function index() {
       echo $this->View->render('welcome', ['title' => 'Contact Manager']);
    }

}
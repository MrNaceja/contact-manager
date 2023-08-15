<?php

namespace App\Controller;

use App\Controller\PageController;

class ContactController extends PageController {

    public function index() {
        return $this->View->render('contact');
    }

}
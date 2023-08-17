<?php

namespace App\Controller;

use App\Controller\PageController;

class ContactController extends PageController {

    public function index() {
        echo $this->View->render('ContactsView', ['title' => 'Contact Manager | Contatos']);
    }

}
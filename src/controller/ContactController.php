<?php

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Contact;

class ContactController extends PageController {

    public function index() {
        $contacts = (new Contact())->read();
        echo $this->View->render('ContactsView', [
            'title'   => 'Contact Manager | Contatos',
            'persons' => $contacts
        ]);
    }

}
<?php

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Contact;
use App\Utils\Enum\EnumActions;

class ContactController extends PageController {

    public function index() {
        $contacts = (new Contact())->read();
        echo $this->View->render('ContactsView', [
            'title'   => 'Contact Manager | Contatos',
            'persons' => $contacts
        ]);
    }

    public function formCreate() {
        echo $this->View->render('ContactView', [
            'title'       => 'Contact Manager | Cadastro de Contato',
            'action'      => EnumActions::ACTION_CREATE,
            'actionTitle' => 'Cadastrar Contato',
        ]);
    }

}
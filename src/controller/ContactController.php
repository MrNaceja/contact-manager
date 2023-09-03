<?php

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Contact;
use App\Model\Person;
use App\Utils\Enum\EnumActions;

class ContactController extends PageController {

    public function index() {
        $contacts = (new Contact())->read();
        echo $this->View->render('ContactsView', [
            'title'   => 'Contact Manager | Contatos',
            'contacts' => $contacts
        ]);
    }

    public function formCreate() {
        $personsAvailable = (new Person())->read();
        echo $this->View->render('ContactView', [
            'title'       => 'Contact Manager | Cadastro de Contato',
            'action'      => EnumActions::ACTION_CREATE,
            'actionTitle' => 'Cadastrar Contato',
            'persons'     => $personsAvailable
        ]);
    }

    public function formShow($id) {
        $contact = (new Contact())->findById($id);
        echo $this->View->render('ContactView', [
            'action'      => EnumActions::ACTION_SHOW,
            'title'       => 'Contact Manager | Visualizar Contato',
            'actionTitle' => 'Detalhes do Contato',
            'contact'     => $contact
        ]);
    }

    public function formUpdate($id) {
        $personsAvailable = (new Person())->read();
        $contact          = (new Contact())->findById($id);
        echo $this->View->render('ContactView', [
            'action'      => EnumActions::ACTION_UPDATE,
            'title'       => 'Contact Manager | Atualizar Contato',
            'actionTitle' => 'Atualizar Contato',
            'contact'     => $contact,
            'persons'      => $personsAvailable
        ]);
    }

    public function create() {
        $person  = (new Person())->findById($_POST['personId']);
        $contact = (new Contact())->setType($_POST['type'])
                                  ->setDescription($_POST['description'])
                                  ->setPerson($person);
        if ($contact->create()) {
            return $this->redirectWithSuccess('/contatos', 'Cadastro de Contato', $contact->getType(true) . ' foi cadastrado para '. $person->getName());
        }
        return $this->redirectWithError('/contatos', 'Cadastro de Contato', 'Problemas ao cadastrar contato');
    }

    public function delete($id) {
        $contact = (new Contact())->findById($id);
        if ($contact->delete()) {
            return $this->redirectWithSuccess('/contatos', 'Exclusão de Contato', $contact->getType(true) . ' foi excluido(a)');
        }
        return $this->redirectWithError('/contatos', 'Exclusão de Contato', 'Problemas ao excluir contato');
    }

}
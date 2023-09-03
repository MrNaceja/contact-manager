<?php

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Contact;
use App\Model\Person;
use App\Utils\Enum\EnumActions;

class ContactController extends PageController {

    /**
     * Visualização de contatos (Consulta de contatos).
     */
    public function index() {
        $contacts = (new Contact())->read();
        echo $this->View->render('ContactsView', [
            'title'   => 'Contact Manager | Contatos',
            'contacts' => $contacts
        ]);
    }

    /**
     * Visualização do formulário de cadastro de contato.
     */
    public function formCreate() {
        $personsAvailable = (new Person())->read();
        echo $this->View->render('ContactView', [
            'title'       => 'Contact Manager | Cadastro de Contato',
            'action'      => EnumActions::ACTION_CREATE,
            'actionTitle' => 'Cadastrar Contato',
            'persons'     => $personsAvailable
        ]);
    }

    /**
     * Visualização do formluario de visualização (detalhes) de contato.
     * 
     * @param int $id
     */
    public function formShow($id) {
        $contact = (new Contact())->findById($id);
        echo $this->View->render('ContactView', [
            'action'      => EnumActions::ACTION_SHOW,
            'title'       => 'Contact Manager | Visualizar Contato',
            'actionTitle' => 'Detalhes do Contato',
            'contact'     => $contact
        ]);
    }

    /**
     * Visualização do formulário de atualização do contato.
     * 
     * @param int $id
     */
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

    /**
     * Realiza o cadastro de um novo contato.
     */
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

    /**
     * Realiza a atualização de um contato.
     */
    public function update() {
        $contact = (new Contact())->findById($_POST['id']);
        $contact->setType($_POST['type'])->setDescription($_POST['description']);
        $contact->getPerson()->setId($_POST['personId']);
        $contact->update();
        return $this->redirectWithSuccess('/contatos', 'Atualização de Contato', $contact->getType(true) . ' foi atualizado(a)');
    }

    /**
     * Realiza a exclusão de um contato.
     * 
     * @param int $id
     */
    public function delete($id) {
        $contact = (new Contact())->findById($id);
        if ($contact->delete()) {
            return $this->redirectWithSuccess('/contatos', 'Exclusão de Contato', $contact->getType(true) . ' foi excluido(a)');
        }
        return $this->redirectWithError('/contatos', 'Exclusão de Contato', 'Problemas ao excluir contato');
    }

}
<?php 

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Person;

use App\Utils\Enum\EnumActions;

class PersonController extends PageController{

    public function index() {
        $persons = (new Person())->read();
        echo $this->View->render('PersonsView', [
            'title'   => 'Contact Manager | Pessoas',
            'persons' => $persons
        ]);
    }

    public function formCreate() {
        echo $this->View->render('PersonView', [
            'action' => EnumActions::ACTION_CREATE,
            'actionTitle' => 'Cadastrar Pessoa',
            'title' => 'Contact Manager | Cadastrar Pessoa'
        ]);
    }
    
    public function formShow($id) {
        $person = (new Person())->findById($id);
        echo $this->View->render('PersonView', [
            'action'      => EnumActions::ACTION_SHOW,
            'actionTitle' => 'Detalhes da Pessoa',
            'title'       => 'Contact Manager | Visualizar Pessoa', 
            'person'      => $person
        ]);
    }

    public function formUpdate($id) {
        $person = (new Person())->findById($id);
        echo $this->View->render('PersonView', [
            'action'      => EnumActions::ACTION_UPDATE,
            'actionTitle' => 'Atualizar Pessoa',
            'title'       => 'Contact Manager | Atualizar Pessoa', 
            'person'      => $person
        ]);
    }

    private function loadContactsPersonFromGrid(Person $person, $isCreation = true) {
        $gridContactsValues = $_POST['contacts'];
        if (!$isCreation) {
            $person->getContacts()->clear();
        }
        array_map(function ($type, $description) use ($person, $isCreation) {
            if (isEmpty($type) && isEmpty($description)) {
                return;
            }
            $person->newContact()->setType($type)->setDescription($description);
        }, $gridContactsValues["type"], $gridContactsValues["description"]);
        return $person;
    }

    public function create() {
        $person = (new Person())->setName($_POST['name'])->setCpf($_POST['cpf']);
        $this->loadContactsPersonFromGrid($person);
        if ($person->create()) {
            return $this->redirectWithSuccess('/pessoas', 'Cadastro de Pessoa', $person->getName() . ' foi cadastrado');
        }
        return $this->redirectWithError('/pessoas', 'Cadastro de Pessoa', 'Problemas ao cadastrar pessoa');
    }

    public function update() {
        $person = (new Person())->findById($_POST['id']);
        $person->setName($_POST['name'])->setCpf($_POST['cpf']);
        $this->loadContactsPersonFromGrid($person, false);
        $person->update();
        return $this->redirectWithSuccess('/pessoas', 'Atualização de Pessoa', $person->getName() . ' foi atualizado');
    }

    public function delete($id) {
        $person = (new Person())->findById($id);
        if ($person->delete()) {
            return $this->redirectWithSuccess('/pessoas', 'Exclusão de Pessoa', $person->getName() . ' foi excluido');
        }
        return $this->redirectWithError('/pessoas', 'Exclusão de Pessoa', 'Problemas ao excluir pessoa');
    }

}
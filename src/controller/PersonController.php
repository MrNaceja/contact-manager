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

    public function create() {
        $person  = (new Person())->setName($_POST['name'])->setCpf($_POST['cpf']);
        $person->create();
        return $this->redirectWithSuccess('/pessoas', 'Cadastro de Pessoa', $person->getName() . ' foi cadastrado');
    }

    public function update() {
        $person = (new Person())->findById($_POST['id']);
        $person->setName($_POST['name'])->setCpf($_POST['cpf']);
        $person->update();
        return $this->redirectWithSuccess('/pessoas', 'Atualização de Pessoa', $person->getName() . ' foi atualizado');
    }

    public function delete($id) {
        $person = (new Person())->findById($id);
        $person->delete();
        return $this->redirectWithSuccess('/pessoas', 'Exclusão de Pessoa', $person->getName() . ' foi excluido');
    }

}
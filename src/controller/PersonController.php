<?php 

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Person;

use App\Utils\Enum\EnumActions;

class PersonController extends PageController{

    /**
     * Visualização de pessoas cadastradas (Consulta de pessoas).
     */
    public function index($personNameSearch = null) {
        $persons = (new Person())->read();
        if ($personNameSearch) {
            $persons = array_filter($persons, function ($person) use($personNameSearch) {
                return strpos(strtolower($person->getName()), strtolower($personNameSearch)) !== false;
            });
        }
        echo $this->View->render('PersonsView', [
            'title'   => 'Contact Manager | Pessoas',
            'persons' => $persons
        ]);
    }

    /**
     * Visualização de pessoas conforme busca pelo nome.
     */
    public function search ($personName) {
        return $this->index($personName);
    }

    /**
     * Visualização do Formulário de cadastro de pessoa.
     */
    public function formCreate() {
        echo $this->View->render('PersonView', [
            'action' => EnumActions::ACTION_CREATE,
            'actionTitle' => 'Cadastrar Pessoa',
            'title' => 'Contact Manager | Cadastrar Pessoa'
        ]);
    }
    
    /**
     * Visualização do Formulário de visualização (detalhes) de pessoa.
     * 
     * @param int $id ID da Pessoa
     */
    public function formShow($id) {
        $person = (new Person())->findById($id);
        echo $this->View->render('PersonView', [
            'action'      => EnumActions::ACTION_SHOW,
            'actionTitle' => 'Detalhes da Pessoa',
            'title'       => 'Contact Manager | Visualizar Pessoa', 
            'person'      => $person
        ]);
    }

    /**
     * Visualização do Formulário de atualização de pessoa.
     * 
     * @param int $id ID da Pessoa
     */
    public function formUpdate($id) {
        $person = (new Person())->findById($id);
        echo $this->View->render('PersonView', [
            'action'      => EnumActions::ACTION_UPDATE,
            'actionTitle' => 'Atualizar Pessoa',
            'title'       => 'Contact Manager | Atualizar Pessoa', 
            'person'      => $person
        ]);
    }

    /**
     * Carrega o grid contatos na pessoa.
     * 
     * @param Person $person Pessoa para carregar os contatos
     * @param bool $isCreation Indica se é criação, do contrário é alteração
     */
    private function loadContactsPersonFromGrid(Person $person, $isCreation = true) {
        $gridContactsValues = $_POST['contacts'];
        if (!$isCreation) {
            $person->getContacts()->clear();
        }
        array_map(function ($type, $description) use ($person) {
            if (isEmpty($description)) {
                return;
            }
            $person->newContact()->setType($type)->setDescription($description);
        }, $gridContactsValues["type"], $gridContactsValues["description"]);
        return $person;
    }
    /**
     * Realiza o cadastro de uma pessoa.
     */
    public function create() {
        $person = (new Person())->setName($_POST['name'])->setCpf($_POST['cpf']);
        $this->loadContactsPersonFromGrid($person);
        if ($person->create()) {
            return $this->redirectWithSuccess('/pessoas', 'Cadastro de Pessoa', $person->getName() . ' foi cadastrado(a)');
        }
        return $this->redirectWithError('/pessoas', 'Cadastro de Pessoa', 'Problemas ao cadastrar pessoa');
    }
    /**
     * Realiza a atualização de uma pessoa.
     */
    public function update() {
        $person = (new Person())->findById($_POST['id']);
        $person->setName($_POST['name'])->setCpf($_POST['cpf']);
        $this->loadContactsPersonFromGrid($person, false);
        $person->update();
        return $this->redirectWithSuccess('/pessoas', 'Atualização de Pessoa', $person->getName() . ' foi atualizado(a)');
    }
    /**
     * Realiza a exclusão de uma pessoa.
     * 
     * @param int $id
     */
    public function delete($id) {
        $person = (new Person())->findById($id);
        if ($person->delete()) {
            return $this->redirectWithSuccess('/pessoas', 'Exclusão de Pessoa', $person->getName() . ' foi excluido(a)');
        }
        return $this->redirectWithError('/pessoas', 'Exclusão de Pessoa', 'Problemas ao excluir pessoa');
    }

}
<?php 

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Person;
use Exception;

class PersonController extends PageController{

    public function index() {
        $persons = [
            [ 'name' => "teste1", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 1 ],
            [ 'name' => "teste2", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 2 ],
            [ 'name' => "teste3", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 3 ],
            [ 'name' => "teste4", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 4 ],
            [ 'name' => "teste5", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 5 ],
            [ 'name' => "teste6", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 6 ],
            [ 'name' => "teste7", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 7 ],
            [ 'name' => "teste8", 'cpf' => 'xxx.xxx.xxx.xx', 'id' => 8 ],
        ];
        echo $this->View->render('PersonsView', [
            'title' => 'Contact Manager | Pessoas',
            'persons' => $persons
        ]);
    }

    public function create() {
        $personData = getSendedData();
        $person     = (new Person())->setName($personData['name'])->setCpf($personData['cpf']);
        // $person->create();
        echo json_encode([ 'status' => 200, 'message' => 'Pessoa criada com sucesso!', 'data' => $person->asJson() ]);
        exit();
    }

}
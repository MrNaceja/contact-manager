<?php 

namespace App\Controller;

use App\Controller\PageController;
use App\Model\Person;
use Exception;

class PersonController extends PageController{

    public function index() {
        $persons = [(new Person())->setName('Eduardo')->setCpf('099.754.889-43')->setId(1)];
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

    public function info($id) {
        echo json_encode(['status' => 200, 'message' => 'Chegou no controlador', 'data' => $id]);
        exit();
    }

}
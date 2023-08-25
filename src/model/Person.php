<?php

namespace App\Model;

use Doctrine\ORM\Mapping as Orm;

#[Orm\Entity]
#[Orm\Table(name:'persons')]
class Person extends Model {

    #[Orm\Id]
    #[Orm\GeneratedValue]
    #[Orm\Column(type:'integer')]
    private int|null $id = null;

    #[Orm\Column(type: 'string')]
    private string $name;

    #[Orm\Column(type: 'string', length:14)]
    private string $cpf;

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function setCpf(string $cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getCpf() : string {
        return $this->cpf;
    }

    public function getId() : int|null {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function asJson() : array {
        return [
            'id'   => $this->getId(),
            'name' => $this->getName(),
            'cpf'  => $this->getCpf()
        ];
    }
    
}
<?php

namespace App\Model;

use Doctrine\ORM\Mapping as Orm;

#[Orm\Entity]
#[Orm\Table(name:'contacts')]
class Contact extends Model {

    #[Orm\Id]
    #[Orm\GeneratedValue]
    #[Orm\Column(type:'integer')]
    private int|null $id;

    #[Orm\Column(type: 'typeContact')]
    private int $type;

    #[Orm\Column(type: 'string')]
    private string $description;

    #[Orm\ManyToOne(targetEntity:Person::class, inversedBy:'contacts')]
    #[Orm\JoinColumn(name: 'id_person', referencedColumnName:'id')]
    private Person $Person;

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPerson() : Person {
        return $this->Person;
    }

    public function setPerson(Person $person) {
        $this->Person = $person;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

}
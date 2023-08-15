<?php

namespace App\Model;

use Doctrine\ORM\Mapping as Orm;

#[Orm\Entity]
#[Orm\Table(name:'contacts')]
class Contact {

    #[Orm\Id]
    #[Orm\GeneratedValue]
    #[Orm\Column(type:'integer')]
    private int|null $id;

    #[Orm\Column(type: 'typeContact')]
    private int $type;

    #[Orm\Column(type: 'string')]
    private string $description;

}
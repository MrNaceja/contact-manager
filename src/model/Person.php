<?php

namespace App\Model;

use Doctrine\ORM\Mapping as Orm;

/**
 * @Orm\Entity
 * @Orm\Table(name='persons')
 */
class Person {

    /**
     * @Orm\Id
     * @Orm\Column(type='integer')
     * @Orm\GeneratedValue
     */
    private int|null $id;

    /**
     * @Orm\Column(type='string')
     */
    private string $name;

    /**
     * @Orm\Column(type='string')
     */
    private string $cpf;
    
}
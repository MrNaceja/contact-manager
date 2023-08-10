<?php

namespace App\Model;

use Doctrine\ORM\Mapping as Orm;

/**
 * @Orm\Entity
 * @Orm\Table(name='contacts')
 */
class Contact {

    /**
     * @Orm\Id
     * @Orm\Column(type='integer')
     * @Orm\GeneratedValue
     */
    private int|null $id;

    /**
     * @Orm\Column(type='string')
     */
    private int $type;

    /**
     * @Orm\Column(type='string')
     */
    private string $description;

}
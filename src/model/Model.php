<?php 

namespace App\Model;

abstract class Model {

    public function create() {
        global $entityManager;
        $entityManager->persist($this);
        $entityManager->flush();
    }

    public abstract function asJson() : array;

}
<?php 

namespace App\Model;

abstract class Model {
    
    public function create() {
        global $entityManager;
        $entityManager->persist($this);
        $entityManager->flush();
    }

    public function delete() {
        global $entityManager;
        $entityManager->remove($this);
        $entityManager->flush();
    }

    public function read() {
        global $entityManager;
        $productRepository = $entityManager->getRepository($this::class);
       return $productRepository->findAll();
    }

    public function findById(string $id) {
        global $entityManager;
        return $entityManager->find($this::class, $id);
    }

    public function update() {
        global $entityManager;
        $entityManager->flush();
    }

}
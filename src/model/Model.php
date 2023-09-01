<?php 

namespace App\Model;

use Throwable;

abstract class Model {
    
    public function create() : bool {
        global $entityManager;
        try {
            $entityManager->persist($this);
            $entityManager->flush();
            return true;
        }
        catch (Throwable $e) {
            return false;
        }
    }

    public function delete() : bool {
        global $entityManager;
        try {
            $entityManager->remove($this);
            $entityManager->flush();
            return true;
        }
        catch (Throwable $e) {
            return false;
        }
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

    public function update() : bool {
        global $entityManager;
        try {
            $entityManager->flush();
            return true;
        }
        catch (Throwable $e) {
            return false;
        }
    }

}
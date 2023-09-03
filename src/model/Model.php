<?php 

namespace App\Model;

use Throwable;

abstract class Model {
    
    /**
     * Realiza a criação de um registro do modelo (INSERT).
     */
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

    /**
     * Realiza a exclusão de um registro do modelo (DELETE).
     */
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

    /**
     * Realiza a busca de todos os registros de modelo (SELECT *).
     */
    public function read() {
        global $entityManager;
        $Repository = $entityManager->getRepository($this::class);
        return $Repository->findAll();
    }

    /**
     * Realiza a busca de um registro de modelo para o ID fornecido (SELECT).
     * 
     * @param string $id
     */
    public function findById(string $id) {
        global $entityManager;
        return $entityManager->find($this::class, $id);
    }

    /**
     * Realiza a atualização do registro de modelo (UPDATE).
     */
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
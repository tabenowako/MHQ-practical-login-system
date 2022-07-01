<?php

namespace App\Contracts;
use App\Entity\Entity;

interface RepositoryInterface{

    
    public function find($id): ?object;

    public function findOneBy(string $string, $value): ?object;

    public function findBy(array $criteria);

    public function findAll();

    public function create(Entity $entity): ?object;

    public function update(Entity $entity, array $conditions = []): ?object;

    public function delete(Entity $entity, array $conditions = []): void;

}
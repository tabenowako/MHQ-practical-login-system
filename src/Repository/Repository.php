<?php

namespace App\Repository;
use App\Entity\Entity;
use App\Database\QueryBuilder;
use App\Contracts\RepositoryInterface;

abstract class Repository implements RepositoryInterface {

    protected static $table;
    protected static $className;

    /** @var QueryBuilder $queryBuilder **/
    private $queryBuilder;


    public function __construct(QueryBuilder $queryBuilder){
        $this->queryBuilder = $queryBuilder;
    }

    public function find($id): ?object{
    return $this->findOneBy('id', $id);
    }

    public function findOneBy(string $field, $value): ?object{
        $result = $this->queryBuilder->table(static::$table)
                            ->select()->where($field, $value)
                            ->fetchInto(static::$className);
        return ($result) ? $result[0] : null;
    }

    public function findBy(array $criteria){
        $this->queryBuilder->table(static::$table)->select();
        foreach($criteria as $criterion){
            $this->queryBuilder->where(...$criterion); //[["email", "=", "email@mail.com"], ["firstname", "=", "TestName"]]
        }

       return $this->queryBuilder->fetchInto(static::$className); //an object array is return. 1 object will be $result[0]

    }

    public function findAll() {
         return $this->queryBuilder->raw("SELECT * FROM ".static::$table)->fetchInto(static::$className);
    }

    public function create(Entity $entity): ?object{
         $id = $this->queryBuilder->table(static::$table)->create($entity->toArray());
         return $this->find($id);
    }

    public function update(Entity $entity, array $conditions = []): ?object{
        $this->queryBuilder->table(static::$table)->update($entity->toArray());
        foreach($conditions as $condition){
         $this->queryBuilder->where(...$condition);
        }
    
        $this->queryBuilder->where('id', $entity->getId());
        return $this->find($entity->getId());

    }

    public function delete(Entity $entity, array $conditions = []): void{

        $this->queryBuilder->table(static::$table)->delete($entity->toArray());
        foreach($conditions as $condition){
         $this->queryBuilder->where(...$condition);
        }

        $this->queryBuilder->where('id', $entity->getId());
    }

}








?>
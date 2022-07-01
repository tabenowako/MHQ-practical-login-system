<?php

if(isset($_POST, $_POST['delete'])){

    try{
    $queryBuilder = QueryBuilderFactory::make();
    $repository = new MHQRepositoryRepository($queryBuilder);

    $user = $repository->find((int)$_POST['id']);
    $repository->delete($user);

    }catch(\Throwable $exception){
     //exception
    }

    $users = $repository->findAll();
}

?>

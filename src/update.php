<?php

if(isset($_POST, $_POST['update'])){

    try{
    $queryBuilder = QueryBuilderFactory::make();
    $repository = new MHQRepository($queryBuilder);

    //find the user with the id posted
    $user = $repository->find((int)$_POST['id']);
    $email= $_POST['email'];

    $user->setEmail($email);

    $updatedUser = $repository->update($user);

    }catch(\Throwable $exception){
     //Exception
    }

    //To pass to ui
    //$users = $repository->findAll();
}

?>

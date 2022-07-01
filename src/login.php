<?php

if(isset($_POST, $_POST['login'])){

    $email= $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $data = [
        'email' => $email,
        'password' => $password
    ];

    try{

    $queryBuilder = QueryBuilderFactory::make();
    $repository = new MHQRepository($queryBuilder);

    $checkUser = $repository->findBy($data);

    if($checkUser) {
        //do logics for login
    }

    }catch(\Throwable $exception){
     //throw exception
    }

    //To pass to the ui
    //$users = $repository->findAll();
}

?>
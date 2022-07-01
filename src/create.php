<?php

if(isset($_POST, $_POST['create'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email= $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        //throw exception and display error message
    }

    $mhquser = new MHQLogin;
    $mhquser->setFirstName($firstname);
    $mhquser->setLastName($firstname);
    $mhquser->setEmail($email);
    $mhquser->setPassword($password);

    try{
    $queryBuilder = QueryBuilderFactory::make();
    $repository = new MHQRepository($queryBuilder);

    $newUser = $repository->create($mhquser);

    }catch(\Throwable $exception){
     //throw exception
    }

    //to pass to ui
    //$users = $repository->findAll();
}

?>
<?php

$queryBuilder = \App\Helpers\QueryBuilderFactory::make();
$repository = new MHQRepository($queryBuilder);
$users = $repository->findAll();

?>
<?php

namespace App\Repository;
use App\Entity\MHQLogin;

class MHQRepository extends Repository{

    protected static $table = "dhqlogin";
    protected static $className = MHQLogin::class;

}


?>
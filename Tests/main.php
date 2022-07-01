<?php declare(strict_types = 1);

require_once __DIR__ . "/vendor/autoload.php";

use App\Entity\MHQLogin;
use App\Repository\MHQRepository;
use App\Helpers\QueryBuilderFactory;

require_once __DIR__."/src/create.php";
require_once __DIR__."/src/login.php";
require_once __DIR__."/src/read.php";
require_once __DIR__."/src/update.php";
require_once __DIR__."/src/delete.php";

?>
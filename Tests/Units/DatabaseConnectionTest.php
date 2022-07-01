<?php
namespace Tests\Units;

use App\Database\PDOConnection;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;
use App\Contracts\DatabaseConnectionInterface;


class DatabaseConnectionTest extends TestCase{

    public function testItCanConnectToDatabaseWithPdo(){

        $credentials = $this->getCredentials("pdo");
        $pdo = (new PDOConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class, $pdo);

        return $pdo;
    }
  
    /** @depends testItCanConnectToDatabaseWithPdo */
    public function testItIsAValidPdoConnection(DatabaseConnectionInterface $pdo){
        self::assertInstanceOf(\PDO::class, $pdo->getConnection());
    }

    private function getCredentials(string $type){
         return Config::get("database", $type);
    }
}


?>
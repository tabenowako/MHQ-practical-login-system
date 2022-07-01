<?php

namespace Tests\Units;
use PHPUnit\Framework\TestCase;
use App\Helpers\QueryBuilderFactory;

class QueryBuilderTest extends TestCase{

    private $queryBuilder;

    public function setUp():void{
         $this->queryBuilder = QueryBuilderFactory::make("database", "pdo");
         $this->queryBuilder->beginTransaction();
         parent::setUp();
    }

    public function insertIntoTable(){
      $data = ['firstname' => 'Test Name',
                  'lastname' => 'Test Name2',
                  'email' => 'test@mail.com',
                  'password' => 'password123',
                  'created_at' => date('Y-m-d H:i:s')];
        $result = $this->queryBuilder->table('dhqlogin')->create($data);
        return $id = $this->queryBuilder->lastInsertId();
    }

    public function testItCanCreateRecord(){
        $id = $this->insertIntoTable();
        self::assertNotNull($id);
        return $id;
    }

    public function testSelectQuery(){
      $id = $this->insertIntoTable();
      $result = $this->queryBuilder->table('dhqlogin')->select('*')->where('id', $id)->first();
       self::assertNotNull($result);
    }

    public function testItCanPerformSelectQuery(){
         $id = $this->insertIntoTable();
        $result = $this->queryBuilder->table('dhqlogin')->select("*")->where('id',  $id)->first();
        self::assertSame($id, $result->id);
    }

    public function testItCanPerformMultipleSelectQuery(){
         $id = $this->insertIntoTable();
         $result = $this->queryBuilder->table('dhqlogin')->select("*")->where('email', 'test@mail.com')->where('id',  $id)->first();
         self::assertSame($id, $result->id);
    }

    public function testItCanFindById(){
        $id = $this->insertIntoTable();
        $result = $this->queryBuilder->table('dhqlogin')->find($id);
        self::assertSame($id, $result->id);
    }

    public function testItCanFindOneByGivenValue(){
      $id = $this->insertIntoTable();
      $result = $this->queryBuilder->table('dhqlogin')->findOneBy('email', 'test@mail.com');
      self::assertNotNull($result);
  }

    public function testItCanUpdateRecord(){
      $id = $this->insertIntoTable();
      $result = $this->queryBuilder->table('dhqlogin')
                      ->update(['email' => 'test@mail.com'])
                      ->where('id', $id);
      self::assertNotNull($result);
    }

    public function testItCanDeleteRecord(){
      $id = $this->insertIntoTable();
      $result = $this->queryBuilder->table('dhqlogin')
                      ->delete(['email' => 'test@mail.com'])->where('id', $id);
     
      $result = $this->queryBuilder->table('dhqlogin')->find($id);
      self::assertNull($result);

    }

    public function tearDown():void{
      $this->queryBuilder->rollback();
      parent::tearDown();
    }
}


?>
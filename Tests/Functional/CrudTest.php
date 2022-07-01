<?php  

namespace Tests\Functional;
use PHPUnit\Framework\TestCase;
use App\Helpers\QueryBuilderFactory;
use App\Repository\MHQRepository;
use App\Entity\MHQLogin;
use App\Helpers\HttpClient;

class CrudTest extends TestCase{

    private $repository;
    private $queryBuilder;
    private $client;

    public function setUp():void{   
        $this->queryBuilder = QueryBuilderFactory::make();
        $this->repository = new MHQRepository($this->queryBuilder);

        $this->client = new HttpClient();
        parent::setUp();
    }

    public function testItCanCreateUser(){
        $postData = $this->getPostData(['create' => true]);
        $response = $this->client->post("http://localhost/mhq-practical-login-system/src/create.php", $postData);

       self::assertEquals(200, json_decode($response, true)['statusCode']);

        $result = $this->repository->findBy([
            ["firstname", "=", "Test Name"],
            ["email", "=", "test@mail.com"]
        ]);

      $mhqUser = $result[0]?? [];

      self::assertInstanceOf(MHQLogin::class, $mhqUser);
      self::assertSame("test@mail.com", $mhqUser->getEmail());
      self::assertSame("Test Name", $mhqUser->getFirstName());

      return  $mhqUser;
  }

    public function testItCanLoginUser(){
          $postData = $this->getPostData(['login' => true], true);
          $response = $this->client->post("http://localhost/mhq-practical-login-system/src/login.php", $postData);

         // self::assertEquals(200, json_decode($response, true)['statusCode']);

          $result = $this->repository->findBy([
              ["firstname", "=", "Test Name"],
              ["email", "=", "test@mail.com"]
          ]);

        $mhqUser = $result[0]?? [];

        self::assertInstanceOf(MHQLogin::class, $mhqUser);
        self::assertSame("test@mail.com", $mhqUser->getEmail());
        self::assertSame("Test Name", $mhqUser->getFirstName());
    }

    /** @depends testItCanCreateUser */
    public function testItCanUpdateUsertUsingPostRequest(MHQLogin $mhqUser){
        $postData = ['update' => true,
                    "email" => "newemail@mail.com",
                    "id" => $mhqUser->getId()
         ];

       $response =  $this->client->post("http://localhost/mhq-practical-login-system/src/update.php", $postData);
       self::assertEquals(200, json_decode($response, true)['statusCode']);

        $mhqUser = $this->repository->find($mhqUser->getId());

        self::assertInstanceOf(MHQLogin::class, $mhqUser);
        self::assertSame("newemail@mail.com", $mhqUser->getEmail());

        return $mhqUser;
   }

     /** @depends testItCanUpdateUsertUsingPostRequest */
     public function testItCanDeleteUserUsingPostRequest(MHQLogin $mhqUser){
        $postData = ['delete' => true,
                    "email" => "newemail@mail.com",
                    "id" => $mhqUser->getId()
         ];

        $response = $this->client->post("http://localhost/mhq-practical-login-system/src/delete.php", $postData);
        self::assertEquals(200, json_decode($response, true)['statusCode']);

        $mhqUser = $this->repository->find($mhqUser->getId());
        self::assertNull($mhqUser);
   }

   public function testItCanReadUsersUsingPostRequest(){
       $response = $this->client->get("http://localhost/mhq-practical-login-system/src/read.php");
       self::assertEquals(200, json_decode($response, true)['statusCode']);
   }

    private function getPostData(array $options = [], $is_login = false): array{ 
        //options checks post btn etc
        if ( $is_login ) {
            return array_merge([
                "email" => "test@mail.com",
                "password" => "passsword123"
            ], $options);
        }

        return array_merge([
            "firstname" => "Test Name",
            "lastname" => "Test Name2",
            "email" => "test@mail.com",
            "password" => "passsword123",
            "confirm_password" => 'password123'
        ], $options);
    }

    public function tearDown():void{
     $this->queryBuilder->rollback();
        parent::tearDown();
    }

}

?>
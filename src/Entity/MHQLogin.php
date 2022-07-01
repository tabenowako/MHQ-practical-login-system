<?php

namespace App\Entity;

class MHQLogin extends Entity{

    private $id;
    private $firstname; 
    private $lastname;  
    private $email; 
    private $password;
    private $created_at;

   public function getId(): int{
       return (int)$this->id;
   }

   public function setFirstName(string $firstname){
      $this->firstname = $firstname;
      return $this;
    }

    /**
     * @return string
     */
   public function getFirstName(): string{
     return $this->firstname;
    }   

    public function setLastName(string $lasttname){
      $this->lastname = $lastname;
      return $this;
    }

    /**
     * @return string
     */
   public function getLastName(): string{
     return $this->lastname;
    }   

    public function setEmail(string $email){
        $this->email  = $email;
        return $this;
      }
  
    /**
     * @return string
     */
     public function getEmail(): string{
       return $this->email;
      }   


    public function setPassword(?string $password){
    $this->password  = $password;
    return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string{
    return $this->password;
    }   

    public function getCreatedAt(){
      return $this->created_at;
    }

   public function toArray(): array{
        return [
            'firstname' => $this->getFirstName(),
            'lastname' => $this->getLastName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'created_at' => $this->getCreatedAt(),
        ];
   }

}



?>
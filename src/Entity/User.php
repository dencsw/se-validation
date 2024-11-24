<?php
namespace App\Entity; 
use Symfony\Component\Validator\Constraints as Assert;

class User {  
    #[Assert\Positive(message:"ID should be positive.")]    
    private int $id;

    #[Assert\NotBlank]
    #[Assert\Length(
         min:3,
         max:80,
         minMessage:"Name is too short.",
         maxMessage:"Name is too long.")]
    private string $name;

   
    #[Assert\Email]
    private string $email;
  
    #[Assert\NotBlank]
    #[Assert\Length(
        min:6,
        max:16,
        minMessage:"Password is too short [min is 6].",
        maxMessage:"Password is too long [max is 16].")]
    private string $password;

    private \DateTime $createdAt;

    public function __construct(int $id, string $name, string $email, string $password) {
        
        $this->id =$id;
        $this->name =$name;
        $this->email =$email;
        $this->password =$password;
        $this->createdAt = new \DateTime();
        $this->createdAt->setTimezone(new \DateTimeZone('Europe/Moscow'));

    } 
    public function getCreatedDate(): \DateTime {
        return $this->createdAt;
    }
    public function getName():string {
        return $this->name;
    }
    public function getData() :string
    {
        return "User [". $this->id . "]: ". $this->name." | ".$this->email." | ".$this->password." | ".$this->createdAt->format('Y-m-d H:i:s') ;
    }
}
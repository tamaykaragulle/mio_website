<?php
namespace App\Entities\User;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 


class User{
    protected string $username;
    protected string $name;
    protected string $surname;
    protected string $email;
    protected int $age;
    protected string $gender;
    protected \DateTimeImmutable $registrationDate;
    protected \DateTimeImmutable $lastActiveDate;
    protected string $imageURL;

    function __construct(){
        $this->setLastActiveDate(new \DateTimeImmutable());
    }

    public function getUsername():string{return $this->username;}
    public function getName():string{return $this->name;}
    public function getSurname():string{return $this->surname;}
    public function getEmail():string{return $this->email;}
    public function getAge():int{return $this->age;}
    public function getGender():string{return $this->gender;}
    public function getRegistrationDate():\DateTimeImmutable{return $this->registrationDate;}
    public function getLastActiveDate():\DateTimeImmutable{return $this->lastActiveDate;}
    public function getImageURL():string{return $this->imageURL;}

    public function getFormattedRegistrationDate():string{return $this->registrationDate->format('Y-m-d');}
    public function getFormattedLastActiveDate():string{return $this->lastActiveDate->format('Y-m-d');}
    
    public function setUsername(string $username){
        $this->username = $username;
    }
    public function setName(string $name){
        $this->name = $name;
    }
    public function setSurname(string $surname){
        $this->surname = $surname;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }
    public function setAge(int $age){
        $this->age = $age;
    }
    public function setGender(string $gender){
        $this->gender = $gender;
    }
    public function setLastActiveDate(\DateTimeImmutable $date){
        $this->lastActiveDate = $date;
    }
    public function setRegistrationDate(\DateTimeImmutable $date){
        $this->registrationDate = $date;
    }
    public function setImageURL(string $url){
        $this->imageURL = $url;
    }

    public function login(string $password):bool{
        return true;
    }
    public function register(string $password):bool{
        return true;
    }
}
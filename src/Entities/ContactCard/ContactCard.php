<?php
namespace App\Entities\ContactCard;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
class ContactCard{
    private string $name;
    private string $surname;
    private string $phoneNumber;
    private string $email;
    private string $message;

    public function __construct(){
        $this->name = "";
        $this->surname = "";
        $this->phoneNumber = "";
        $this->address = "";
        $this->email = "";
        $this->message = "";
    }

    public function getName():string{return $this->name;}
    public function getSurname():string{return $this->surname;}
    public function getPhoneNumber():string{return $this->phoneNumber;}
    public function getEmail():string{return $this->email;}
    public function getMessage():string{return $this->message;}

    public function setName(string $name){$this->name = $name;}
    public function setSurname(string $surname){$this->surname = $surname;}
    public function setPhoneNumber(string $phoneNumber){$this->phoneNumber = $phoneNumber;}
    public function setEmail(string $email){$this->email = $email;}
    public function setMessage(string $message){$this->message = $message;}
    
}

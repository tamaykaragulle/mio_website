<?php
namespace App\Entities\Service;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
class Service{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $imageURL;
    protected float $price;
    protected int $quantity;
    protected \DateTimeImmutable $addDate;
    public function __construct(){
    }

    public function getId():int{return $this->id;}    
    public function getName():string{return $this->name;}
    public function getDescription():string{return $this->description;}
    public function getImageURL():string{return $this->imageURL;}
    public function getPrice():int{return $this->price;}
    public function getQuantity():int{return $this->quantity;}
    public function getAddDate():\DateTimeImmutable{return $this->addDate;}

    public function getFormattedAddDate():string{return $this->addDate->format('Y-m-d');}
 
    
    public function setName(string $name){
        $this->name = $name;
    }
    public function setDescription(string $description){
        $this->description = $description;
    }
    public function setImageURL(string $url){
        $this->imageURL = $url;
    }
    public function setPrice(float $price){
        if($price <= 0) $this->price = $price;
    }
    public function setQuantity(int $quantity){
        if($quantity < 0) $this->quantity = $quantity;
    }
    public function setAddDate(\DateTimeImmutable $date){
        if($this->addDate) $this->addDate = $date;
    }

    
}
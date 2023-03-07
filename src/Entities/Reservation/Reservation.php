<?php
namespace App\Entities\Reservation;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
class Reservation{
    protected int $id;
    protected int $therapyId;
    protected string $therapistUsername;
    protected string $customerUsername;
    protected \DateTimeImmutable $reservationDate;
    public function __construct(){

    }

    public function getId():int{return $this->id;}
    public function getTherapyId():int{return $this->therapyId;}
    public function getTherapistUsername():string{return $this->therapistUsername;}
    public function getCustomerUsername():string{return $this->customerUsername;}
    public function getReservationDate():\DateTimeImmutable{return $this->reservationDate;}
    public function getFormattedReservationDate():string{return $this->reservationDate->format('Y-m-d');}

    public function setTherapistUsername(string $username){
        $this->therapistUsername = $username;
    }
    public function setCustomerUsername(string $username){
        $this->customerUsername = $username;
    }
    public function setReservationDate(\DateTimeImmutable $date){
        $this->reservationDate = $date;
    }
}
<?php
namespace App\Connectors\DatabaseConnector;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
use App\Connectors\DatabaseConnector\DatabaseConnectorModes;
use App\Connectors\DatabaseConnector\DatabaseConnectorGroups;
use App\Entities\User\User;
use App\Entities\Service\Service;
use App\Entities\Reservation\Reservation;
use App\Entities\ContactCard\ContactCard;
use App\Util\Validators\EntityValidator\EntityValidator;



class DatabaseConnector {
    private \mysqli $mysqli;
    private string $mode;
    private DatabaseConnectorModes $modes;
    private DatabaseConnectorGroups $groups;
    private EntityValidator $validator;

    public function __construct(){
        $this->modes = new DatabaseConnectorModes();
        $this->groups = new DatabaseConnectorGroups();
        $this->validator = new EntityValidator();
    }

    private function init():bool{
        $this->mysqli = new \mysqli("localhost", $this->group, "#B!je?651*rK", "mio_db");
        // check if connection was succesful
        if($this->mysqli->connect_errno) return false;
        //check if server is alive, i.e server is responding
        if(!$this->mysqli->ping()) return false;
        $this->mysqli->set_charset("utf8mb4");
        return true;
    }

    private function close():bool{
        // if connection was not successful, return false as it is already NOT open and can NOT be closed
        if($this->mysqli->connect_errno) return false;
        // else close the connection and return true
        $this->mysqli->close();
        return true;
    }

    private function modeExists(string $mode):bool{
        return in_array($mode, get_class_vars(get_class($this->modes)));
    }
    
    public function groupExists(string $group):bool{
        return in_array($group, get_class_vars(get_class($this->groups)));
    }

    public function setMode(string $mode):bool{
        if($this->modeExists($mode)){
            $this->mode = $mode;
            return true;
        }
        return false;
    }

    public function setGroup(string $group):bool{
        if($this->groupExists($group)){
            $this->group = $group;
            return true;
        }
        return false;
    }

    public function insert(Object $obj):bool{
        if(! $this->validator->validate($obj)) return false;
        switch($this->mode){
            case "User": return $this->insertUser($obj, "password");
            break;
            case "Reservation": return $this->insertReservation($obj);
            break;
            case "Service": return $this->insertService($obj);
            break;
            case "ContactCard": return $this->insertContactCard($obj);
            break;
        }
    }

    public function adminAuth(string $username, string $password){
        $this->init();
        $st = $this->mysqli->prepare("SELECT * FROM admin WHERE username=? and password=?");
        $st->bind_param("ss",$username, $password);
        $st->execute();
        $result = $st->get_result()->fetch_all(MYSQLI_ASSOC);
        $this->close();
        return count($result) > 0;
    }

    public function fetchAll(){
        switch($this->mode){
            case "Service":
                return $this->fetchAllServices();
                break;
        }
    }

    private function fetchAllServices(){
        $this->init();
        $st = $this->mysqli->prepare("SELECT * FROM services");
        $st->execute();
        $result = $st->get_result()->fetch_all(MYSQLI_ASSOC);
        $this->close();
        return $result;
    }

    private function insertUser(User $u, string $password):bool{
        if(! ($this->groupExists($this->group) && ($this->group==$this->groups->User || $this->group==$this->groups->Admin))) return false;
        if(! $this->init() || ! $this->validator->validate($u)) return false;
        $st = $this->mysqli->prepare("INSERT INTO users(username,password,name,surname,age,gender,registration_date,last_active_date,image) VALUES(?,?,?,?,?,?,?,?,?)");
        $hashedPw = password_hash($password, PASSWORD_DEFAULT);
        $st->bind_param("ssssds", $u->getUsername(), $hashedPw, $u->getName(), $u->getSurname(), $u->getAge(), $u->getGender(), $u->getFormattedRegistrationDate(), $u->getFormattedLastActiveDate(), $u->getImageURL());
        $st->execute();
        $this->close();
        return $st;
    }



    private function insertService(Service $p):bool{
        if(! ($this->groupExists($this->group) && $this->group==$this->groups->Admin)) return false;
        if(! $this->init() || ! $this->validator->validate($p)) return false;
        $st = $this->mysqli->prepare("INSERT INTO services(name,description,price,quantity) VALUES(?,?,?,?)");
        $st->bind_param("ssdd", $p->getName(), $p->getDescription(), $p->getPrice(), $p->getQuantity());
        $st->execute();
        $this->close();
        return $st;
    }

    private function insertReservation(Reservation $r):bool{
        if(! ($this->groupExists($this->group) && ($this->group==$this->groups->Admin || $this->group == $this->groups->User))) 
        return false;
        if(! $this->init() || ! $this->validator->validate($r)) return false;
        $st = $this->mysqli->prepare("INSERT INTO reservations(therapy_id,therapist_username,customer_username,reservation_date)
                                     VALUES(?,?,?,?");
        $st->bind_param("dsss", $r->getId(), $r->getTherapistUsername(), $r->getCustomerUsername(), $r->getReservationDate());                                     
        $st->execute();
        $this->close();
        return $st;

    }




    private function insertContactCard(ContactCard $cc):bool{
        if(! ($this->groupExists($this->group) && 
        ($this->group==$this->groups->Admin || $this->group==$this->groups->User))) return false;
        if(! $this->init() || !$this->validator->validate($cc)) return false;
        $st = $this->mysqli->prepare("INSERT INTO contacts(name,surname,phone_number,email,message) VALUES(?,?,?,?,?)");
        $name = $cc->getName();
        $surname = $cc->getSurname();
        $phone  = $cc->getPhoneNumber();
        $email = $cc->getEmail();
        $message = $cc->getMessage();
        $st->bind_param("sssss", $name,$surname,$phone,$email,$message);
        $st->execute();       
        $this->close();
        return $st != null;
    }

    // TO DO
    public function filter(string $mode, array $parameters):array{
        $table = "";
        switch($mode){
            case "Contact": $table = "contacts"; break;
            case "Service": $table = "services"; break;
            case "Swiper": $table = "swiper_slides"; break;
        }
        $params = array();
        foreach($parameters as $option => $value){
            switch($option){
                // CONTINUE FROM HERE
            }
        }
        
        /*PLACEHOLDER*/ return array();
    }
    
}
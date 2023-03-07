<?php
namespace App\Handlers\RequestHandler;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
use App\Connectors\DatabaseConnector\DatabaseConnector;
use App\Entities\ContactCard\ContactCard;
use App\Util\Helpers\MailHelper\MailHelper;

class RequestHandler {
    private array $requests;
    private string $request;
    private DatabaseConnector $dc;
    private MailHelper $mh;

    public function __construct(){
        $this->init();
    }

    private function init():void{
        $this->requests = array("get-service-list", 
                                "insert-contact-to-database", 
                                "insert-contact-to-mailchimp",
                                "admin-auth");
        $this->request = "";
        $this->dc = new DatabaseConnector();
        $this->mh = new MailHelper();
    }

    public function request(string $request, array $args=array()){
        if($this->setRequest($request))
            return $this->handle($args);
    }

    private function setRequest($request):bool{
        if(!$this->requestExists($request)) return false;
        $this->request = $request;
        return true;
    }

    private function requestExists($request):bool{
        return in_array($request, $this->requests);
    }

    private function handle(array $args=array()){
        if(empty($this->request)) return;
        switch($this->request){
            case "get-service-list":
                    $this->dc->setGroup("user");
                    $this->dc->setMode("Service");
                    return $this->dc->fetchAll();
                break;
            case "insert-contact-to-database":
                if(!empty($args)){
                    $this->dc->setGroup('user');
                    $this->dc->setMode("ContactCard");
                    $contactCard = new ContactCard();
                    $contactCard->setName($args['name']);
                    $contactCard->setSurname($args['surname']);
                    $contactCard->setEmail($args['email']);
                    $contactCard->setPhoneNumber($args['phone']);
                    $contactCard->setMessage($args['message']);
                    return $this->dc->insert($contactCard);
                }
                break;
            case "insert-contact-to-mailchimp":
                if(!empty($args)){
                    $contactCard = new ContactCard();
                    $contactCard->setName($args['name']);
                    $contactCard->setSurname($args['surname']);
                    $contactCard->setEmail($args['email']);
                    $contactCard->setPhoneNumber($args['phone']);
                    $contactCard->setMessage($args['message']);
                    return $this->mh->addContact($contactCard);
                }
                break;
            case "admin-auth":
                if(!empty($args)){
                    $this->dc->setGroup('admin');
                    $username = $args['admin-username'];
                    $password = $args['admin-password'];
                    return $this->dc->adminAuth($username, $password);
                }
                break;
        }
    }

   
}
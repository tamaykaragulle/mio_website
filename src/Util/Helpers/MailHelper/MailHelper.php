<?php
namespace App\Util\Helpers\MailHelper;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
use App\Entities\ContactCard\ContactCard;

class MailHelper{
    private \MailchimpMarketing\ApiClient $mailchimp;
    private string $listId;

    public function __construct(){
        $this->init();
    }

    private function init():void{
        $this->mailchimp = new \MailchimpMarketing\ApiClient();
        $this->mailchimp->setConfig([
            "apiKey" => "761c03ea5f26d704d68a220420e47e35-us10",
            "server" => "us10"
        ]);
        $this->listId = "5ca17cbdc2";
    }

    /* public function createAudience():string{
        try {
            $response = $this->mailchimp->lists->createList([
              "name" => "Contact added",
              "email_type_option" => false,
              "contact" => [
                "company" => "Mio",
                "address1" => "Lorem Ipsum",
                "city" => "Istanbul",
                "zip" => "12345",
                "country" => "TR",
              ],
              "campaign_defaults" => [
                "from_name" => "Berk Kıroğlu",
                "from_email" => "kirogluberk@gmail.com",
                "subject" => "Your contact information has been registered",
                "language" => "TR",
              ],
            ]);
            return $response;
          } catch (\MailchimpMarketing\ApiException $e) {
            return $e->getMessage();
          }
    } */

    

    public function addContact(ContactCard $cc):string{
        try{
            $response = "";
            if(empty($cc->getMessage())){
                $response = $this->mailchimp->lists->addListMember($this->listId, [
                    "email_address" => $cc->getEmail(),
                    "status" => "subscribed",
                    "merge_fields" => [
                        "FNAME" => $cc->getName(),
                        "LNAME" => $cc->getSurname(),
                        "PHONE" => $cc->getPhoneNumber()
                    ]
                ]);
            }
            else{
                $response = $this->mailchimp->lists->addListMember($this->listId, [
                    "email_address" => $cc->getEmail(),
                    "status" => "subscribed",
                    "merge_fields" => [
                        "FNAME" => $cc->getName(),
                        "LNAME" => $cc->getSurname(),
                        "MESSAGE" => $cc->getMessage(),
                        "PHONE" => $cc->getPhoneNumber()
                    ]
                ]);
            }
            return $response->{"status"};
        }catch(\Exception $e){
            return $e->getCode();
        }
    }

    public function getResponse(){
        return $this->mailchimp->ping->get();
    }
}
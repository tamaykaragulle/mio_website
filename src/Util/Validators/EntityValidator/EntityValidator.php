<?php
namespace App\Util\Validators\EntityValidator;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 

class EntityValidator{
    private Object $obj;
    public function __construct(Object|null $obj=null){
        $this->setObject($obj);
    }

    public function validate(Object|null $obj=null):bool{
        if($this->setObject($obj)){
            $vars = get_class_vars(get_class($this->obj));
            foreach($vars as $var){
                if(!isset($var) || empty($var)) return false;
            }
            return true;
        }
        return false; 
    }

    public function getObject():Object{
        return $this->obj;
    }
    public function setObject(Object|null $obj):bool{
        if(isset($obj) && ! empty($obj)){
            $this->obj = $obj;
            return true;
        }
        return false;
    }
    public function getObjectClass():string{
        return get_class($this->obj);
    }
 
}
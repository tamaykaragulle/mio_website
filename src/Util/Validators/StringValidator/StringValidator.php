<?php
namespace App\Util\Validators\StringValidator;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
use App\Util\Validators\StringValidator\StringValidatorModes;

class StringValidator {
    
    private string $mode;
    private string $string;
    private int $maxLength;
    private int $minLength;
    public StringValidatorModes $modes;


    public function __construct(string $string="",  string $mode = ""){
        $this->modes = new StringValidatorModes();
        $this->maxLength = -1;
        $this->minLength = -1;
        $this->setMode($mode);
        $this->string = $string;
    }

    public function setString(string $string){
        $this->string = $string;
    }
    public function setMode(string $mode):bool{
        if($this->modeExists($mode)){
            $this->mode = $mode;
            $this->update();
            return true;
        }
        $this->mode = "";
        return false;
    }
    public function update():void{
        if($this->mode == $this->modes->NameSurname){
            $this->maxLength = 30;
            $this->minLength = 3;
        }
        elseif($this->mode == $this->modes->Email){
            $this->maxLength = 100;
            $this->minLength = 10;
        }
        elseif($this->mode == $this->modes->Password){
            $this->maxLength = 30;
            $this->minLength = 8;
        }
        elseif($this->mode == $this->modes->NameSurname){
            $this->maxLength = 100;
            $this->minLength = 3;
        }
    }
    
    private function modeExists(string $mode):bool{
        return in_array($mode, get_class_vars(get_class($this->modes)));
    }

    private function isReady():bool{
        return $this->minLength > 0;
    }

    public function validate():bool|null{
        if(! $this->isReady()) return null;
        $len = strlen($this->string);
        if($len < $this->minLength or $len > $this->maxLength) return null;
        if($this->mode == $this->modes->NameSurname){
            return preg_match('/^[ıİğĞüÜşŞöÖçÇa-zA-Z)]*$/', $this->string);
        }
        elseif($this->mode == $this->modes->Email){
            return preg_match('/^\w*@{1}\w*\.com$/', $this->string); 
        }
        elseif($this->mode == $this->modes->Password){
            return preg_match('/^[a-zA-Z0-9_]*$/', $this->string);
        }
        elseif($this->mode == $this->modes->ProductName){
            return preg_match('/^[a-ZA-Z0-9]*$/', $this->string);
        }
    }
}   
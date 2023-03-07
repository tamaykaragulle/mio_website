<?php
namespace App\Util\Helpers\Filterer;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php";

use App\Connectors\DatabaseConnector\DatabaseConnector;

class FilterHelper{
    private string $mode;
    private array $modes;
    private array $options;
    private array $values;
    private array $params;

    private DatabaseConnector $dc;

    public function __construct(){
        $this->init();
    }

    private function init(){
        $this->mode = "";
        $this->modes = array("Service", "Contact", "Swiper");
        $this->dc = new DatabaseConnector();
        $this->options = array(
        "search-title", 
        "search-email", 
        "search-phone",
        "search-address",
        "search-name",
        "min-price", 
        "max-price",
        "price");
        $this->values = array("ascend", "descend");
        $this->params = array();
    }

    private function modeExists(string $mode):bool{
        return in_array($mode, $this->modes);
    }

    private function optionExists(string $option):bool{
        return in_array($option, $this->options);
    }

    private function valueExists(string $value):bool{
        return in_array($value, array_values($this->values));
    }

    private function isOptionFlexible(string $option):bool{
        return in_array($option, array("search-title","search-email","search-phone","search-address","search-name","min-price","max-price"));
    }

    public function clearParams():void{
        $this->params = array();
    }

    public function setMode(string $mode):bool{
        if(empty($mode) || ! $this->modeExists($mode)) return false;
        $this->mode = $mode;
        $this->clearParams();
        return true;
    }

    public function setOption(string $option, string $value):bool{
        if( (empty($option) || ! $this->optionExists($option)) 
            ||
            (! $this->isOptionFlexible($option) && !$this->valueExists($value))) 
            return false;
        $this->params[$option] = $value;
        return true;
    }

    public function filter():array{
        return $this->dc->filter($this->mode, $this->params);
    }
}
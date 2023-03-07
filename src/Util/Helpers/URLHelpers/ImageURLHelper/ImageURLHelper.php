<?php
namespace App\Util\Helpers\URLHelpers\ImageURLHelper;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 
use App\Util\Helpers\URLHelpers\ImageURLHelper\ImageURLHelperModes;

class ImageURLHelper{
    private string $mode;
    private string $protocol;
    private string $host;
    private ImageURLHelperModes $modes;

    public function __construct(){
        $this->init();
    }

    private function init(){
        $this->mode = "";
        $this->protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        $this->host = $_SERVER['HTTP_HOST'];
        $this->modes = new ImageURLHelperModes();
    }

    public function setMode(string $mode):bool{
        if(!$this->modeExists($mode)) return false;
        $this->mode = $mode;
        return true;
    }

    private function modeExists(string $mode):bool{
        return in_array($mode, get_class_vars(get_class($this->modes)));
    }


    public function get(string $target){
        if(!isset($this->mode) || empty($this->mode)) return;
        $path = $this->protocol.$this->host."/resources/images/";
        switch($this->mode){
            case "Services":
                $path .= "services/";
                break;
            case "About":
                $path .= "about/";
                break;
            case "Contact":
                $path .= "contact/";
                break;
            case "Footer":
                $path .= "footer/";
                break;
            case "Navbar":
                $path .= "navbar/";
                break;
            case "Swiper":
                $path .= "swiper/";
                break;
            default: return;
        }
        $localpath = $_SERVER['DOCUMENT_ROOT']."/resources/images/".strtolower($this->mode)."/";
        if($dh = opendir($localpath)){
            while( ($file = readdir($dh)) !== false){
                if(is_file($localpath.$file)){
                    $filename = basename($file);
                    if(explode(".", $filename)[0] == $target){
                        $path .= $filename;
                    }
                }
            }
        }
        return $path;
    }

}


<?php

namespace App\Util\Helpers\ImageUploadHelper;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php";

class ImageUploadHelper {
    private string $imageDir;
    private string $mode;
    private array $modes;

    public function __construct(){
        $this->init();
    }

    private function init(){
        $this->imageDir = $_SERVER['DOCUMENT_ROOT']."/resources/images/";
        $this->mode = "";
        $this->modes = array("service","contact","swiper");
    }

    private function modeExists($mode){
        return in_array($mode,$this->modes);   
    }

    public function setMode($mode):bool{
        if($this->modeExists($mode)){
            $this->mode = $mode;
            return true;
        }
        return false;
    }

    private function isFileImage($file):bool{
        $flag = getimagesize($file)
    }

    public function setFile($file):bool{

    }


}
<?php
namespace App\Util\Injectors\StyleInjector;

class StyleInjector{
    private array $styles = array();

    public function __construct(){
        $this->init();
    }

    private function init():void{
        $root = $_SERVER["DOCUMENT_ROOT"];
        $dir = $root."/resources/styles/";
        if($dirHandle = opendir($dir)){
            while( ($file = readdir($dirHandle)) !== false){
                if(is_file($dir.$file)){
                    $filename = basename($file, '.css');
                    $filedir = $dir.$file;
                    $this->styles[$filename] = $filedir;
                }
            }
        }
    }

    private function styleExists(string $style):bool{
        return in_array($style, array_keys($this->styles));
    }

    public function inject(string $style):string{
        if(empty($style)  || ! $this->styleExists($style)) return "";
        return "<style>".file_get_contents($this->styles[$style])."</style>";
    }
}
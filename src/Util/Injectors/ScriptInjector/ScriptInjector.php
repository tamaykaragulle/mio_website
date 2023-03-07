<?php
namespace App\Util\Injectors\ScriptInjector;

class ScriptInjector {
    private array $scripts;

    public function __construct(){
        $this->scripts = array();
        $this->init();
    }

    private function init():void{
        $root = $_SERVER["DOCUMENT_ROOT"];
        $dir = $root."/resources/scripts/";
        if($dirHandle = opendir($dir)){
            while( ($file = readdir($dirHandle)) !== false){
                if(is_file($dir.$file)){
                    $filename = basename($file, '.js');
                    $filedir = $dir.$file;
                    $this->scripts[$filename] = $filedir;
                }
            }
        }
    }

    public function inject($script):string{
        if($this->scriptExists($script))
        return $this->cleanScript(file_get_contents($this->scripts[$script]));
    }

    private function scriptExists(string $script):bool{
        return in_array($script, array_keys($this->scripts));
    }

    private function cleanScript($script):string{
        if(substr(trim($script),0,2) == '/*' && substr(trim($script),-2) == '*/')
        return substr($script, 2, strlen($script)-4);
        return $script;
    }

   
}
<?php
    $root = ($_SERVER["DOCUMENT_ROOT"]);
    require $root."/./vendor/autoload.php"; 
    use App\Util\Injectors\TemplateInjector\TemplateInjector;
    use App\Util\Injectors\StyleInjector\StyleInjector;
    $styleInjector = new StyleInjector();


    //create a controller class in 'src' which will define contents according to the targeted
    //URL of the website, then that class will take this 'Layout' file and inject the content
    //into the <content></content> markup section
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $styleInjector->inject("Main");?>
    
    </head>
    <body>

    </body>
</html>
<?php
namespace App\Util\Helpers\URLHelpers\ImageURLHelper;
$root = ($_SERVER["DOCUMENT_ROOT"]);
require $root."/../vendor/autoload.php"; 

class ImageURLHelperModes {
    var $services = "Services";
    var $footer = "Footer";
    var $navbar = "Navbar";
    var $about = "About";
    var $swiper = "Swiper";
    var $contact = "Contact";
}
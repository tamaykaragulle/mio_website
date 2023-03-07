<?php
    $root = ($_SERVER["DOCUMENT_ROOT"]);
    require $root."/../vendor/autoload.php"; 
    use App\Util\Injectors\TemplateInjector\TemplateInjector;
    use App\Util\Injectors\StyleInjector\StyleInjector;
    use App\Util\Injectors\ScriptInjector\ScriptInjector;
    use App\Handlers\RequestHandler\RequestHandler;
    use App\Util\Helpers\URLHelpers\ImageURLHelper\ImageURLHelper;

    $styleInjector = new StyleInjector();
    $scriptInjector = new ScriptInjector();
    
    $rh = new RequestHandler();
    $services = $rh->request("get-service-list");
    $helper = new ImageURLHelper();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Prices</title>
    <?php 
        echo $styleInjector->inject("Fonts");
        echo $styleInjector->inject("Main"); 
        echo $styleInjector->inject("NavbarStyle");
        echo $styleInjector->inject("ServicesStyle");
        echo $styleInjector->inject("FooterStyle");
        
    ?>
</head>

<body>

    <!-- NAVBAR SECTION -->
    <?php 
        $helper->setMode("Navbar"); 
        echo $scriptInjector->inject("TogglePopup");
        echo $scriptInjector->inject("AutoCloseDropdown");
        echo $scriptInjector->inject("ToggleDropdown");
        echo $scriptInjector->inject("ToggleMap");
    ?>
    <nav class="menu">
        <div class="top-nav">
            <div class="social-media">
                <ul>
                    <li><a href="https://www.facebook.com/">
                            <img src=<?php echo "'".$helper->get("facebook_round_icon")."'";?> alt="facebook"></i></a></li>
                    <li><a href="https://www.twitter.com/"><img src=<?php echo "'".$helper->get("twitter_round_icon")."'";?>
                                alt="twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/"><img src=<?php echo "'".$helper->get("instagram_round_icon")."'";?>
                                alt="instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-nav">
            <a onclick="toggleDropdown()" class="toggle-dropdown" href="#">
                <img src=<?php echo "'".$helper->get("dropdown_icon")."'";?> alt="V">
            </a>
            <div class="dropdown" id="dropdown">
                <div class="dropdown-content">
                    <div class="dropdown-anchor-container">
                        <a href="anasayfa">ANASAYFA</a>
                    </div>
                    <div class="dropdown-anchor-container">
                        <a href="hizmetler">HİZMETLERİMİZ</a>
                    </div>
                    <div class="dropdown-anchor-container">
                        <a href="anasayfa-hakkimizda">HAKKIMIZDA</a>
                    </div>
                    <div class="dropdown-anchor-container">
                        <a style="border-bottom:none" href="anasayfa-iletisim">İLETİŞİM</a>
                    </div>
                </div>
                <div class="dropdown-close-button-container">
                    <img onclick="closePopups()" src=<?php echo "'".$helper->get("close_button_icon")."'"; ?> alt="CLOSE">
                </div>
            </div>
            <a id="logo-anchor" href="anasayfa"><img id="logo" src=<?php echo "'".$helper->get("mio_logo")."'";?> alt="logo"></a>
            <ul>
                <li><a id="index-anchor" href="anasayfa">ANASAYFA</a></li>
                <li><a id="services-anchor" href="hizmetler">HİZMETLERİMİZ</a></li>
                <li><a id="about-anchor" href="anasayfa-hakkimizda">HAKKIMIZDA</a></li>
                <li><a class="contact-anchor" href="anasayfa-iletisim">İLETİŞİM</a></li>
            </ul>
            <!-- DISABLED UNTIL AFTER LOGIN/REGISTER FUNCTIONALITY HAS BEEN ADDED -->
            <!-- <span id="auth-span"><a id="auth-link" href="Login.php">LOGIN</a></span> -->
        </div>
    </nav>

    <content>

        <?php $helper->setMode("Services");?>

        <!-- SERVICES SECTION -->

        <div class="services">
            <?php 
            for($i = 0; $i < count(array_keys($services)); $i++){
                $service = $services[$i];
                ?>
                <div class='service-popup' id='<?php echo "service-".$i;?>'>
                    <div class="service-popup-image">
                        <img src=<?php echo "'".$helper->get($service['image'])."'"; ?> alt=<?php echo "'".$service['title']."'"; ?>>
                    </div>
                    <div class="service-popup-info">
                        <div class="service-popup-title">
                            <?php echo $service['title']; ?>
                        </div>
                        <div class="service-popup-description">
                            <?php echo $service['description']; ?>
                        </div>
                    </div>
                
                    <div class="service-popup-price">
                        <?php echo $service['price']." $"; ?>
                    </div>
                    <div class="service-popup-close-button">
                        <img onclick="closePopups()" src=<?php echo "'".$helper->get("close_button_icon")."'"; ?> alt="CLOSE">
                    </div>  
                </div>
                <button onclick=<?php echo "'togglePopup(".'"service-'.$i.'"'.")'";?>>
                
                <?php
                echo "<div class='service-container'>".
                        "<div class='service-image-container'>".
                            "<img src='".$helper->get($service['image'])."' alt='".$service['title']." image'>".
                        "</div>".
                    "<div class='service-info-container'>".
                    "<div class ='service-title-container'>".
                    $service['title'].
                    "</div>".
                    "<div class='service-description-container'>".
                    $service['description'].
                    "</div>".
                    "</div>".
                    "<div class='service-price-container'>".
                    $service['price']." $".
                    "</div>".
                    "</div>".
                    "</button>";
            }
        ?>
        </div>



    </content>

    <?php $helper->setMode("Footer"); ?>

    <!-- FOOTER SECTION -->

    <?php $helper->setMode("Footer"); ?>
    <footer>
        <div class="contact-info">
            <h3 class="contact-info-title"><span>İLETİŞİM BİLGİLERİ</span></h3>
            <div class="info-box">
                <div class="info-container">
                    <button onclick="toggleMap()" class="map-button"><a href="Index.php#map"><img
                                src=<?php echo "'".$helper->get("hyperlink_icon")."'"; ?> alt="Link:"></button>
                    <p class="contact-info-address">Istanbul<br>TURKIYE</p></a>
                </div>
                <div class="info-container">
                    <img src=<?php echo "'".$helper->get("mail_icon")."'"; ?> alt="Mail:">
                    <a class="contact-info-email" href="mailto:asdasd@gmail.com">example@gmail.com</a>
                </div>
                <div class="info-container">
                    <img src=<?php echo "'".$helper->get("phone_icon")."'"; ?> alt="Phone:">
                    <a class="contact-info-phone" href="tel:05055555555">0505 555 55 55</a>
                </div>
            </div>
        </div>
        <div id="map" class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d192698.5521409693!2d28.871753927084946!3d41.005236293264716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1660298391646!5m2!1str!2str"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        </div>
    </footer>



</body>

</html>
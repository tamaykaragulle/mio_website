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
    $helper = new ImageURLHelper();
    $rh = new RequestHandler();

?>

<!DOCTYPE html>
<html xmlns="Layout" lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
            echo $styleInjector->inject("Fonts");
            echo $styleInjector->inject("Main");
            echo $styleInjector->inject("SwiperStyle");
            echo $styleInjector->inject("FooterStyle");
            echo $styleInjector->inject("NavbarStyle");
            echo $styleInjector->inject("ContactCardStyle");
            echo $styleInjector->inject("AboutStyle");
            echo $styleInjector->inject("NotifierStyle");
        ?>
    <script src="https://kit.fontawesome.com/058fa91423.js" crossorigin="anonymous"></script>
</head>

<body>


    

    <?php
        echo $scriptInjector->inject("AutoCloseDropdown");
        echo $scriptInjector->inject("ToggleDropdown");
        echo $scriptInjector->inject("SmoothScroll");
        echo $scriptInjector->inject("ToggleMap");


        // CONTACT CARD POST
        if(isset($_POST["contact-first-name"]) && !empty($_POST["contact-first-name"]) &&
           isset($_POST["contact-last-name"])  && !empty($_POST["contact-last-name"]) &&
           isset($_POST["contact-email"])      && !empty($_POST["contact-email"]) &&
           isset($_POST["contact-mobile"])     && !empty($_POST["contact-mobile"]) &&
           isset($_POST["contact-message"])   &&  !empty($_POST["contact-message"])){
                $args = array( "name"=>$_POST['contact-first-name'],
                               "surname"=>$_POST['contact-last-name'],
                               "email"=>$_POST['contact-email'],
                               "phone"=>$_POST['contact-mobile'],
                               "message"=>$_POST['contact-message']);
                $rh->request("insert-contact-to-database", $args);
                $mailchimpResponse = $rh->request("insert-contact-to-mailchimp", $args);  

            }

          // TODO: add code to notify user when insertion is succcesfull.!!

    ?>


<!-- NOTIFIER  SECTION -->

<?php
    $gotResponse = isset($mailchimpResponse) && !empty($mailchimpResponse);
    
?>

<div class="notifier-container">
    <span class="notifier-text<?php if($gotResponse){ if($mailchimpResponse=='400') echo ' red'; else echo ' green'; }?>">
        <?php 
            if($gotResponse){            
                if($mailchimpResponse === "400"){
                    echo "Girdiğiniz e-mail üzerine bir kayıt zaten bulunuyor.";
                }
                if($mailchimpResponse === "subscribed"){
                    echo "İletişim bilgileriniz kaydedildi.";
                }
            } 
        ?>
    </span>
</div>




<!-- NAVBAR SECTION -->

    <?php 
        $helper->setMode("Navbar"); 
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
                    <img onclick="toggleDropdown()" src=<?php $helper->setMode("Services"); echo "'".$helper->get("close_button_icon")."'"; $helper->setMode("Navbar"); ?> alt="CLOSE">
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









        <!-- SWIPER SECTION -->

        <?php $helper->setMode("Swiper"); ?>
        <div class="container">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-title="hello"><img
                            src=<?php echo "'".$helper->get("swiper_img_1")."'"; ?> alt=""></div>
                    <div class="swiper-slide"><img src=<?php echo "'".$helper->get("swiper_img_2")."'"; ?> alt=""></div>
                    <div class="swiper-slide"><img src=<?php echo "'".$helper->get("swiper_img_3")."'"; ?> alt=""></div>
                </div>
                <div class="swiper-info">
                    <span class="swiper-title">MIO</span>
                    <br><br>
                    <span class="swiper-subtitle">Güzellik Merkezi</span>
                    <br><br>
                    <a href="Index.php#contact">SİZE ULAŞALIM</a>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>






        <!--  ABOUT SECTION  -->

        <?php $helper->setMode("About"); ?>
        <section id="about" class="about">
            <div class="about-image">
                <img src=<?php echo "'".$helper->get("about_img")."'" ?> alt="About us image">
            </div>
            <div class="about-info">
                <div class="about-title">
                    <h2>Hakkımızda</h2>
                </div>
                <div class="about-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis molestias reprehenderit expedita
                    nam
                    aperiam
                    numquam officiis dicta vitae voluptatibus, esse sit hic eum rem laborum, et corrupti quibusdam illum
                    voluptas
                    odio dolores in a repudiandae soluta. Nisi eveniet vel autem voluptas ut? Repudiandae libero fugiat
                    eius ad
                    ipsum fuga commodi debitis numquam obcaecati molestiae, harum sit, dolorem aliquid expedita itaque.
                </div>
            </div>
        </section>







        <!-- CONTACT CARD SECTION -->

        <?php $helper->setMode("Contact"); ?>
        <div id="contact" class="contact-box">
            <div class="contact-img">
                <img src=<?php echo "'".$helper->get("contact_img")."'"; ?> alt="Güzellik salonu temalı resim">
            </div>
            <div class="contact-form">
                <h3>İLETİŞİM</h3>
                <h2>Biz sizi arayalım</h2>
                <form method="post" action="Index.php">
                    <div class="form-box">
                        <div class="row50">
                            <div class="input-box">
                                <input name="contact-first-name" type="text" placeholder="Name">
                            </div>
                            <div class="input-box">
                                <input name="contact-last-name" type="text" placeholder="Surname">
                            </div>
                        </div>
                        <div class="row50">
                            <div class="input-box">
                                <input name="contact-email" type="text" placeholder="Email">
                            </div>
                            <div class="input-box">
                                <input name="contact-mobile" type="text" placeholder="Phone number">
                            </div>
                        </div>

                        <div class="row100">
                            <div class="input-box">
                                <textarea placeholder="Message (optional)" name="contact-message" id="" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>

                        <div class="row100">
                            <div class="input-box">
                                <input type="submit" value="SEND NOW">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </content>

    <?php  ?>






    
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

    <?php 
        echo $scriptInjector->inject("SwiperScript");
    ?>
</body>

</html>
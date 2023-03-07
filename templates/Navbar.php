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
                        <a href="Index.php">ANASAYFA</a>
                    </div>
                    <div class="dropdown-anchor-container">
                        <a href="Services.php">HİZMETLERİMİZ</a>
                    </div>
                    <div class="dropdown-anchor-container">
                        <a href="Index.php#about">HAKKIMIZDA</a>
                    </div>
                    <div class="dropdown-anchor-container">
                        <a href="Index.php#contact">İLETİŞİM</a>
                    </div>
                </div>
            </div>
            <ul>
                <img id="logo" src=<?php echo "'".$helper->get("mio_logo")."'";?> alt="logo">
                <li><a id="index-anchor" href="Index.php">ANASAYFA</a></li>
                <li><a id="services-anchor" href="Services.php">HİZMETLERİMİZ</a></li>
                <li><a id="about-anchor" href="Index.php#about">HAKKIMIZDA</a></li>
                <li><a class="contact-anchor" href="Index.php#contact">İLETİŞİM</a></li>
            </ul>

            <!-- DISABLED UNTIL AFTER LOGIN/REGISTER FUNCTIONALITY HAS BEEN ADDED -->
            <!-- <span id="auth-span"><a id="auth-link" href="Login.php">LOGIN</a></span> -->
        </div>
    </nav>